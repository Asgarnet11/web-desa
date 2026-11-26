<?php

namespace App\Services;

use App\Enums\HubunganKeluarga;
use App\Enums\JenisMutasi;
use App\Enums\KategoriPemantauan;
use App\Enums\StatusKependudukan;
use App\Enums\StatusVerifikasi;
use App\Enums\TingkatRisikoKesehatan;
use App\Models\KartuKeluarga;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
use App\Models\Penduduk;
use App\Models\User;
use App\Support\KependudukanSecurity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class MutasiPendudukService
{
    public function __construct(
        protected DemografiSyncService $demografiSyncService
    ) {}

    /**
     * Verify a submitted LAMPID mutation and atomically apply side-effects to citizen ledger and demographics.
     */
    public function verifikasiDanTerapkan(MutasiPenduduk $mutasi, User $verifikator, ?string $catatan = null): MutasiPenduduk
    {
        if ($mutasi->disinkronkan_pada !== null) {
            throw new RuntimeException('Mutasi kependudukan ini sudah pernah disahkan dan disinkronkan sebelumnya.');
        }

        return DB::transaction(function () use ($mutasi, $verifikator, $catatan): MutasiPenduduk {
            $payload = $mutasi->payload_data ?? [];
            $nomorSurat = $mutasi->nomor_surat_pengantar ?: $this->generateNomorSurat($mutasi);

            match ($mutasi->jenis_mutasi) {
                JenisMutasi::Kelahiran => $this->prosesKelahiran($mutasi, $payload, $nomorSurat),
                JenisMutasi::Datang => $this->prosesKedatangan($mutasi, $payload),
                JenisMutasi::Kematian => $this->prosesKematian($mutasi),
                JenisMutasi::PindahKeluar => $this->prosesPindahKeluar($mutasi),
                JenisMutasi::PerubahanData => $this->prosesPerubahanData($mutasi, $payload),
            };

            $mutasi->update([
                'nomor_surat_pengantar' => $nomorSurat,
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
                'catatan_verifikasi' => $catatan ?? $mutasi->catatan_verifikasi,
                'diverifikasi_oleh' => $verifikator->id,
                'diverifikasi_pada' => now(),
                'disinkronkan_pada' => now(),
            ]);

            $this->demografiSyncService->syncWilayahAndAncestors(
                $mutasi->wilayah_id,
                (string) ($mutasi->tanggal_peristiwa?->year ?? now()->year)
            );

            return $mutasi->fresh();
        });
    }

    /**
     * Reject a mutation proposal without altering master resident data.
     */
    public function tolak(MutasiPenduduk $mutasi, User $verifikator, string $alasan): MutasiPenduduk
    {
        $mutasi->update([
            'status_verifikasi' => StatusVerifikasi::Ditolak,
            'catatan_verifikasi' => $alasan,
            'diverifikasi_oleh' => $verifikator->id,
            'diverifikasi_pada' => now(),
        ]);

        return $mutasi->fresh();
    }

    protected function prosesKelahiran(MutasiPenduduk $mutasi, array $payload, string $nomorSurat): void
    {
        $bayi = Penduduk::create([
            'wilayah_id' => $mutasi->wilayah_id,
            'kartu_keluarga_id' => $mutasi->kartu_keluarga_id ?? ($payload['kartu_keluarga_id'] ?? null),
            'nik' => $payload['nik'] ?? $this->generateNikSementara('LHR'),
            'nama_lengkap' => $payload['nama_lengkap'] ?? 'Bayi Baru Lahir',
            'jenis_kelamin' => $payload['jenis_kelamin'] ?? 'L',
            'tempat_lahir' => $payload['tempat_lahir'] ?? 'Kabupaten Konawe Selatan',
            'tanggal_lahir' => $mutasi->tanggal_peristiwa,
            'golongan_darah' => $payload['golongan_darah'] ?? null,
            'agama' => $payload['agama'] ?? 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Belum / Tidak Bekerja',
            'pendidikan' => 'Belum Sekolah',
            'hubungan_keluarga' => HubunganKeluarga::Anak,
            'status_kependudukan' => StatusKependudukan::Tetap,
            'status_hidup' => 'hidup',
            'tanggal_terdaftar' => $mutasi->tanggal_peristiwa,
        ]);

        $mutasi->penduduk_id = $bayi->id;

        if (! empty($payload['ibu_penduduk_id'])) {
            PemantauanKesehatan::query()
                ->where('penduduk_id', (int) $payload['ibu_penduduk_id'])
                ->where('kategori', KategoriPemantauan::IbuHamil->value)
                ->where('aktif', true)
                ->get()
                ->each(function (PemantauanKesehatan $bumil) use ($mutasi, $nomorSurat) {
                    $bumil->update([
                        'aktif' => false,
                        'tanggal_selesai' => $mutasi->tanggal_peristiwa,
                        'catatan_tindakan' => trim(($bumil->catatan_tindakan ?? '')."\n[Otomatis] Persalinan diverifikasi lewat mutasi {$nomorSurat}."),
                    ]);
                });
        }

        if (! empty($payload['daftarkan_balita'])) {
            PemantauanKesehatan::create([
                'wilayah_id' => $mutasi->wilayah_id,
                'penduduk_id' => $bayi->id,
                'kategori' => KategoriPemantauan::BalitaGizi,
                'status_risiko' => TingkatRisikoKesehatan::Normal,
                'berat_badan_kg' => isset($payload['berat_lahir_kg']) ? (float) $payload['berat_lahir_kg'] : null,
                'aktif' => true,
                'tanggal_mulai' => $mutasi->tanggal_peristiwa,
                'catatan_tindakan' => 'Pencatatan awal bayi lahir dari mutasi kelahiran resmi.',
                'dicatat_oleh' => $mutasi->diajukan_oleh,
            ]);
        }
    }

    protected function prosesKedatangan(MutasiPenduduk $mutasi, array $payload): void
    {
        $kkId = $mutasi->kartu_keluarga_id;

        if (! $kkId && ! empty($payload['no_kk'])) {
            $kkHash = KependudukanSecurity::hashIdentifier((string) $payload['no_kk']);
            $kk = KartuKeluarga::where('no_kk_hash', $kkHash)->first();

            if (! $kk) {
                $kk = KartuKeluarga::create([
                    'wilayah_id' => $mutasi->wilayah_id,
                    'no_kk' => $payload['no_kk'],
                    'kepala_keluarga_nama' => $payload['kepala_keluarga_nama'] ?? ($payload['nama_lengkap'] ?? 'Kepala Keluarga'),
                    'alamat_ringkas' => $payload['alamat_ringkas'] ?? ($mutasi->asal_atau_tujuan ?? 'Kelurahan Konda'),
                    'status_kk' => 'aktif',
                ]);
            }

            $kkId = $kk->id;
            $mutasi->kartu_keluarga_id = $kkId;
        }

        if ($mutasi->penduduk_id) {
            $penduduk = $mutasi->penduduk;
            $penduduk?->update([
                'wilayah_id' => $mutasi->wilayah_id,
                'kartu_keluarga_id' => $kkId ?? $penduduk->kartu_keluarga_id,
                'status_kependudukan' => $payload['status_kependudukan'] ?? StatusKependudukan::Tetap,
                'status_hidup' => 'hidup',
                'tanggal_terdaftar' => $mutasi->tanggal_peristiwa,
                'tanggal_nonaktif' => null,
            ]);

            return;
        }

        $wargaBaru = Penduduk::create([
            'wilayah_id' => $mutasi->wilayah_id,
            'kartu_keluarga_id' => $kkId,
            'nik' => $payload['nik'] ?? $this->generateNikSementara('DTG'),
            'nama_lengkap' => $payload['nama_lengkap'] ?? 'Pendatang Baru',
            'jenis_kelamin' => $payload['jenis_kelamin'] ?? 'L',
            'tempat_lahir' => $payload['tempat_lahir'] ?? null,
            'tanggal_lahir' => $payload['tanggal_lahir'] ?? now()->subYears(25)->toDateString(),
            'golongan_darah' => $payload['golongan_darah'] ?? null,
            'agama' => $payload['agama'] ?? 'Islam',
            'status_perkawinan' => $payload['status_perkawinan'] ?? 'Kawin',
            'pekerjaan' => $payload['pekerjaan'] ?? 'Karyawan Swasta',
            'pendidikan' => $payload['pendidikan'] ?? 'SMA/SMK',
            'hubungan_keluarga' => $payload['hubungan_keluarga'] ?? HubunganKeluarga::KepalaKeluarga,
            'status_kependudukan' => $payload['status_kependudukan'] ?? StatusKependudukan::Tetap,
            'status_hidup' => 'hidup',
            'tanggal_terdaftar' => $mutasi->tanggal_peristiwa,
        ]);

        $mutasi->penduduk_id = $wargaBaru->id;
    }

    protected function prosesKematian(MutasiPenduduk $mutasi): void
    {
        $penduduk = $mutasi->penduduk;
        if (! $penduduk) {
            throw new RuntimeException('Mutasi kematian harus tertaut ke data penduduk.');
        }

        $penduduk->update([
            'status_kependudukan' => StatusKependudukan::Meninggal,
            'status_hidup' => 'meninggal',
            'tanggal_nonaktif' => $mutasi->tanggal_peristiwa,
        ]);

        PemantauanKesehatan::query()
            ->where('penduduk_id', $penduduk->id)
            ->where('aktif', true)
            ->update([
                'aktif' => false,
                'tanggal_selesai' => $mutasi->tanggal_peristiwa,
            ]);
    }

    protected function prosesPindahKeluar(MutasiPenduduk $mutasi): void
    {
        $penduduk = $mutasi->penduduk;
        if (! $penduduk) {
            throw new RuntimeException('Mutasi pindah keluar harus tertaut ke data penduduk.');
        }

        $penduduk->update([
            'status_kependudukan' => StatusKependudukan::PindahKeluar,
            'status_hidup' => 'pindah_keluar',
            'tanggal_nonaktif' => $mutasi->tanggal_peristiwa,
        ]);

        PemantauanKesehatan::query()
            ->where('penduduk_id', $penduduk->id)
            ->where('aktif', true)
            ->update([
                'aktif' => false,
                'tanggal_selesai' => $mutasi->tanggal_peristiwa,
            ]);

        if ($penduduk->kartu_keluarga_id) {
            $sisaAktifKk = Penduduk::query()
                ->where('kartu_keluarga_id', $penduduk->kartu_keluarga_id)
                ->aktif()
                ->count();

            if ($sisaAktifKk === 0) {
                KartuKeluarga::where('id', $penduduk->kartu_keluarga_id)
                    ->update(['status_kk' => 'pindah']);
            }
        }
    }

    protected function prosesPerubahanData(MutasiPenduduk $mutasi, array $payload): void
    {
        $penduduk = $mutasi->penduduk;
        if (! $penduduk) {
            return;
        }

        $updatable = array_filter([
            'wilayah_id' => $mutasi->wilayah_id,
            'pekerjaan' => $payload['pekerjaan'] ?? null,
            'pendidikan' => $payload['pendidikan'] ?? null,
            'status_perkawinan' => $payload['status_perkawinan'] ?? null,
            'status_kependudukan' => $payload['status_kependudukan'] ?? null,
        ], fn ($v) => $v !== null);

        $penduduk->update($updatable);
    }

    protected function generateNomorSurat(MutasiPenduduk $mutasi): string
    {
        $prefix = $mutasi->jenis_mutasi->prefixSurat();
        $year = $mutasi->tanggal_peristiwa?->year ?? now()->year;

        return sprintf('%s-KND-%s-%s', $prefix, $year, strtoupper(Str::random(5)));
    }

    protected function generateNikSementara(string $prefix): string
    {
        return '740507'.now()->format('dmy').$prefix.random_int(100, 999);
    }
}
