<?php

namespace App\Services;

use App\Enums\JenisKelamin;
use App\Enums\JenisMutasi;
use App\Enums\KategoriPemantauan;
use App\Enums\StatusVerifikasi;
use App\Enums\TingkatRisikoKesehatan;
use App\Enums\TipeWilayah;
use App\Models\Demografi;
use App\Models\KartuKeluarga;
use App\Models\KondisiSosial;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
use App\Models\Penduduk;
use App\Models\Wilayah;

class DemografiSyncService
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    /**
     * Recalculate real-time demographics for a whole Kelurahan tree bottom-up (RT -> RW -> Kelurahan) once each.
     */
    public function syncTree(int $kelurahanId, ?string $periode = null): void
    {
        $periode ??= (string) now()->year;
        $kelurahan = Wilayah::find($kelurahanId);
        if (! $kelurahan) {
            return;
        }

        $rws = Wilayah::where('parent_id', $kelurahan->id)->get();
        foreach ($rws as $rw) {
            $rts = Wilayah::where('parent_id', $rw->id)->get();
            foreach ($rts as $rt) {
                $this->syncSingleWilayah($rt, $periode);
                $this->statistikService->clearCache($rt->id);
            }

            $this->syncSingleWilayah($rw, $periode);
            $this->statistikService->clearCache($rw->id);
        }

        $this->syncSingleWilayah($kelurahan, $periode);
        $this->syncKondisiSosialRingkasan($kelurahan, $periode);
        $this->statistikService->clearCache($kelurahan->id);
    }

    /**
     * Recalculate real-time demographics for a wilayah and cascade upward to Kelurahan/Desa.
     */
    public function syncWilayahAndAncestors(int $wilayahId, ?string $periode = null): void
    {
        $periode ??= (string) now()->year;
        $current = Wilayah::find($wilayahId);
        $visited = [];

        while ($current && ! isset($visited[$current->id])) {
            $visited[$current->id] = true;

            $this->syncSingleWilayah($current, $periode);
            $this->statistikService->clearCache($current->id);

            if (in_array($current->tipe, [TipeWilayah::Kelurahan, TipeWilayah::Desa], true)) {
                $this->syncKondisiSosialRingkasan($current, $periode);
                break;
            }

            $current = $current->parent;
        }
    }

    /**
     * Aggregate active residents, households, health tracking, and vital events for one wilayah node.
     */
    public function syncSingleWilayah(Wilayah $wilayah, ?string $periode = null): Demografi
    {
        $periode ??= (string) now()->year;
        $descendantIds = $wilayah->getDescendantIds(true);

        $pendudukAktif = Penduduk::query()
            ->whereIn('wilayah_id', $descendantIds)
            ->aktif()
            ->get();

        $jumlahKk = KartuKeluarga::query()
            ->whereIn('wilayah_id', $descendantIds)
            ->where('status_kk', 'aktif')
            ->count();

        $lakiLaki = $pendudukAktif->where('jenis_kelamin', JenisKelamin::LakiLaki)->count();
        $perempuan = $pendudukAktif->where('jenis_kelamin', JenisKelamin::Perempuan)->count();

        $usia = [
            '0-14' => 0,
            '15-39' => 0,
            '40-64' => 0,
            '65+' => 0,
        ];

        $pendidikan = [];
        $pekerjaan = [];

        foreach ($pendudukAktif as $warga) {
            $umur = $warga->usia;
            if ($umur <= 14) {
                $usia['0-14']++;
            } elseif ($umur <= 39) {
                $usia['15-39']++;
            } elseif ($umur <= 64) {
                $usia['40-64']++;
            } else {
                $usia['65+']++;
            }

            $labelPend = filled($warga->pendidikan) ? $warga->pendidikan : 'Belum Sekolah / Tidak Terdata';
            $pendidikan[$labelPend] = ($pendidikan[$labelPend] ?? 0) + 1;

            $labelKerja = filled($warga->pekerjaan) ? $warga->pekerjaan : 'Belum / Tidak Bekerja';
            $pekerjaan[$labelKerja] = ($pekerjaan[$labelKerja] ?? 0) + 1;
        }

        // Anonymized active health & family monitoring aggregates
        $kesehatanAktif = PemantauanKesehatan::query()
            ->whereIn('wilayah_id', $descendantIds)
            ->sedangAktif()
            ->get();

        $kesehatan = [
            'ibu_hamil' => $kesehatanAktif->where('kategori', KategoriPemantauan::IbuHamil)->count(),
            'ibu_hamil_risiko' => $kesehatanAktif
                ->where('kategori', KategoriPemantauan::IbuHamil)
                ->whereIn('status_risiko', [TingkatRisikoKesehatan::Kek, TingkatRisikoKesehatan::RisikoTinggi])
                ->count(),
            'balita_gizi' => $kesehatanAktif->where('kategori', KategoriPemantauan::BalitaGizi)->count(),
            'lansia_rentan' => $kesehatanAktif->where('kategori', KategoriPemantauan::LansiaRentan)->count(),
            'disabilitas' => $kesehatanAktif->where('kategori', KategoriPemantauan::Disabilitas)->count(),
        ];

        // Verified LAMPID vital & migration events within the year period
        $mutasiTerverifikasi = MutasiPenduduk::query()
            ->whereIn('wilayah_id', $descendantIds)
            ->where('status_verifikasi', StatusVerifikasi::Terverifikasi->value)
            ->whereYear('tanggal_peristiwa', (int) $periode)
            ->get();

        $mutasi = [
            'kelahiran' => $mutasiTerverifikasi->where('jenis_mutasi', JenisMutasi::Kelahiran)->count(),
            'kematian' => $mutasiTerverifikasi->where('jenis_mutasi', JenisMutasi::Kematian)->count(),
            'datang' => $mutasiTerverifikasi->where('jenis_mutasi', JenisMutasi::Datang)->count(),
            'pindah_keluar' => $mutasiTerverifikasi->where('jenis_mutasi', JenisMutasi::PindahKeluar)->count(),
        ];

        return Demografi::updateOrCreate(
            ['wilayah_id' => $wilayah->id, 'periode' => $periode],
            [
                'jumlah_penduduk' => $pendudukAktif->count(),
                'jumlah_kk' => $jumlahKk,
                'laki_laki' => $lakiLaki,
                'perempuan' => $perempuan,
                'rincian' => [
                    'usia' => $usia,
                    'pendidikan' => $pendidikan,
                    'pekerjaan' => $pekerjaan,
                    'kesehatan_keluarga' => $kesehatan,
                    'mutasi_tahun_ini' => $mutasi,
                ],
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
                'diverifikasi_pada' => now(),
            ]
        );
    }

    /**
     * Keep public KondisiSosial indicators synced dynamically with anonymized health monitoring.
     */
    protected function syncKondisiSosialRingkasan(Wilayah $kelurahan, string $periode): void
    {
        $descendantIds = $kelurahan->getDescendantIds(true);

        $kesehatanAktif = PemantauanKesehatan::query()
            ->whereIn('wilayah_id', $descendantIds)
            ->sedangAktif()
            ->get();

        $bumil = $kesehatanAktif->where('kategori', KategoriPemantauan::IbuHamil)->count();
        $bumilResti = $kesehatanAktif
            ->where('kategori', KategoriPemantauan::IbuHamil)
            ->whereIn('status_risiko', [TingkatRisikoKesehatan::Kek, TingkatRisikoKesehatan::RisikoTinggi])
            ->count();
        $balita = $kesehatanAktif->where('kategori', KategoriPemantauan::BalitaGizi)->count();
        $lansia = $kesehatanAktif->where('kategori', KategoriPemantauan::LansiaRentan)->count();

        $indikatorOtomatis = [
            'Ibu Hamil Terpantau Posyandu' => "{$bumil} Jiwa".($bumilResti > 0 ? " ({$bumilResti} Resti/KEK)" : ''),
            'Balita Terpantau Posyandu' => "{$balita} Balita",
            'Lansia Rentan Terdata' => "{$lansia} Jiwa",
        ];

        foreach ($indikatorOtomatis as $indikator => $nilai) {
            KondisiSosial::updateOrCreate(
                [
                    'wilayah_id' => $kelurahan->id,
                    'indikator' => $indikator,
                    'periode' => $periode,
                ],
                [
                    'nilai' => $nilai,
                    'status_verifikasi' => StatusVerifikasi::Terverifikasi->value,
                ]
            );
        }
    }
}
