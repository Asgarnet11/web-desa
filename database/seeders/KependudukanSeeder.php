<?php

namespace Database\Seeders;

use App\Enums\HubunganKeluarga;
use App\Enums\JenisKelamin;
use App\Enums\JenisMutasi;
use App\Enums\KategoriPemantauan;
use App\Enums\StatusKependudukan;
use App\Enums\StatusVerifikasi;
use App\Enums\TingkatRisikoKesehatan;
use App\Enums\TipeWilayah;
use App\Models\KartuKeluarga;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
use App\Models\Penduduk;
use App\Models\User;
use App\Models\Wilayah;
use App\Services\DemografiSyncService;
use App\Support\KependudukanSecurity;
use Illuminate\Database\Seeder;

class KependudukanSeeder extends Seeder
{
    public function run(): void
    {
        $rts = Wilayah::query()
            ->where('tipe', TipeWilayah::RT->value)
            ->orderBy('kode')
            ->get();

        if ($rts->isEmpty()) {
            return;
        }

        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $rtUser = User::where('email', 'rt01@kelurahan.test')->first();
        $kader = User::where('email', 'kader@kelurahan.test')->first();

        $pekerjaanPool = ['Karyawan Swasta', 'Wirausaha/UMKM', 'PNS/TNI/Polri', 'Jasa/Profesional', 'Pelajar/Mahasiswa'];
        $pendidikanPool = ['SMA/SMK', 'Diploma/Sarjana', 'SMP/Sederajat', 'SD/Sederajat'];
        $namaLaki = ['Ahmad Fauzi', 'Dedi Kurniawan', 'Bambang Wijaya', 'Rudi Hartono', 'Yusuf Pratama', 'Andi Saputra', 'Hendra Gunawan'];
        $namaPerempuan = ['Siti Aminah', 'Rina Wulandari', 'Dewi Lestari', 'Nia Rahmawati', 'Fitri Handayani', 'Sri Wahyuni', 'Lestari Putri'];

        $bumilIndex = 0;

        foreach ($rts as $idx => $rt) {
            // Seed 2 Kartu Keluarga per RT -> 14 KK total across 7 RW (4-5 warga per KK)
            for ($k = 1; $k <= 2; $k++) {
                $seq = ($idx * 10) + $k;
                $noKk = sprintf('327301140120%04d', $seq);
                $kkHash = KependudukanSecurity::hashIdentifier($noKk);
                $kepalaNama = $namaLaki[$seq % count($namaLaki)].' '.chr(65 + ($seq % 26));

                $kk = KartuKeluarga::firstOrCreate(
                    ['no_kk_hash' => $kkHash],
                    [
                        'wilayah_id' => $rt->id,
                        'no_kk' => $noKk,
                        'kepala_keluarga_nama' => $kepalaNama,
                        'alamat_ringkas' => "Jl. Sukawarna No. {$seq}, {$rt->breadcrumb_nama}",
                        'status_kk' => 'aktif',
                    ]
                );

                // Kepala Keluarga (Usia 30-55)
                $nikKk = sprintf('327301010180%04d', $seq);
                Penduduk::firstOrCreate(
                    ['nik_hash' => KependudukanSecurity::hashIdentifier($nikKk)],
                    [
                        'wilayah_id' => $rt->id,
                        'kartu_keluarga_id' => $kk->id,
                        'nik' => $nikKk,
                        'nama_lengkap' => $kepalaNama,
                        'jenis_kelamin' => JenisKelamin::LakiLaki,
                        'tempat_lahir' => 'Bandung',
                        'tanggal_lahir' => now()->subYears(32 + ($seq % 24))->subMonths($k),
                        'hubungan_keluarga' => HubunganKeluarga::KepalaKeluarga,
                        'pekerjaan' => $pekerjaanPool[$seq % count($pekerjaanPool)],
                        'pendidikan' => $pendidikanPool[$seq % count($pendidikanPool)],
                        'status_kependudukan' => StatusKependudukan::Tetap,
                        'status_hidup' => 'hidup',
                        'tanggal_terdaftar' => now()->subYears(3),
                    ]
                );

                // Istri (Usia 25-48)
                $nikIstri = sprintf('327301450485%04d', $seq);
                $istriNama = $namaPerempuan[$seq % count($namaPerempuan)].' '.chr(65 + ($seq % 26));
                $istri = Penduduk::firstOrCreate(
                    ['nik_hash' => KependudukanSecurity::hashIdentifier($nikIstri)],
                    [
                        'wilayah_id' => $rt->id,
                        'kartu_keluarga_id' => $kk->id,
                        'nik' => $nikIstri,
                        'nama_lengkap' => $istriNama,
                        'jenis_kelamin' => JenisKelamin::Perempuan,
                        'tempat_lahir' => 'Bandung',
                        'tanggal_lahir' => now()->subYears(26 + ($seq % 15))->subDays($seq),
                        'hubungan_keluarga' => HubunganKeluarga::Istri,
                        'pekerjaan' => $pekerjaanPool[($seq + 1) % count($pekerjaanPool)],
                        'pendidikan' => $pendidikanPool[($seq + 1) % count($pendidikanPool)],
                        'status_kependudukan' => StatusKependudukan::Tetap,
                        'status_hidup' => 'hidup',
                        'tanggal_terdaftar' => now()->subYears(3),
                    ]
                );

                // Register pregnancy monitoring for selected young mothers
                if ($k === 1 && ($idx % 3 === 0)) {
                    $bumilIndex++;
                    PemantauanKesehatan::firstOrCreate(
                        ['penduduk_id' => $istri->id, 'kategori' => KategoriPemantauan::IbuHamil->value, 'aktif' => true],
                        [
                            'wilayah_id' => $rt->id,
                            'status_risiko' => $bumilIndex === 1 ? TingkatRisikoKesehatan::RisikoTinggi : ($bumilIndex === 2 ? TingkatRisikoKesehatan::Kek : TingkatRisikoKesehatan::Normal),
                            'usia_kehamilan_minggu' => 24 + ($bumilIndex * 3),
                            'hari_perkiraan_lahir' => now()->addWeeks(12 - $bumilIndex)->toDateString(),
                            'berat_badan_kg' => 56.5 + $bumilIndex,
                            'tinggi_badan_cm' => 156,
                            'tanggal_mulai' => now()->subMonths(4)->toDateString(),
                            'catatan_tindakan' => 'Pemeriksaan antenatal Posyandu rutin bulanan & suplementasi tablet tambah darah.',
                            'dicatat_oleh' => $kader?->id,
                        ]
                    );
                }

                // Anak / Balita (Usia 2-18)
                $nikAnak = sprintf('327301120815%04d', $seq);
                $usiaAnak = ($idx + $k) % 2 === 0 ? 3 : 14;
                $anak = Penduduk::firstOrCreate(
                    ['nik_hash' => KependudukanSecurity::hashIdentifier($nikAnak)],
                    [
                        'wilayah_id' => $rt->id,
                        'kartu_keluarga_id' => $kk->id,
                        'nik' => $nikAnak,
                        'nama_lengkap' => ($k === 1 ? 'Rayyan ' : 'Nadia ').$kepalaNama,
                        'jenis_kelamin' => $k === 1 ? JenisKelamin::LakiLaki : JenisKelamin::Perempuan,
                        'tempat_lahir' => 'Bandung',
                        'tanggal_lahir' => now()->subYears($usiaAnak),
                        'hubungan_keluarga' => HubunganKeluarga::Anak,
                        'pekerjaan' => 'Pelajar/Mahasiswa',
                        'pendidikan' => $usiaAnak < 6 ? 'Belum Sekolah' : 'SMP/Sederajat',
                        'status_kependudukan' => StatusKependudukan::Tetap,
                        'status_hidup' => 'hidup',
                        'tanggal_terdaftar' => now()->subYears($usiaAnak),
                    ]
                );

                if ($usiaAnak < 5) {
                    PemantauanKesehatan::firstOrCreate(
                        ['penduduk_id' => $anak->id, 'kategori' => KategoriPemantauan::BalitaGizi->value, 'aktif' => true],
                        [
                            'wilayah_id' => $rt->id,
                            'status_risiko' => TingkatRisikoKesehatan::Normal,
                            'berat_badan_kg' => 13.8,
                            'tinggi_badan_cm' => 94.0,
                            'tanggal_mulai' => now()->subMonths(6)->toDateString(),
                            'catatan_tindakan' => 'Tumbuh kembang normal sesuai KMS Posyandu.',
                            'dicatat_oleh' => $kader?->id,
                        ]
                    );
                }

                // Add elderly member in first KK of odd RTs (age 66+)
                if ($k === 1 && ($idx % 2 === 1)) {
                    $nikLansia = sprintf('327301040258%04d', $seq);
                    $lansia = Penduduk::firstOrCreate(
                        ['nik_hash' => KependudukanSecurity::hashIdentifier($nikLansia)],
                        [
                            'wilayah_id' => $rt->id,
                            'kartu_keluarga_id' => $kk->id,
                            'nik' => $nikLansia,
                            'nama_lengkap' => 'H. Sutisna '.$kepalaNama,
                            'jenis_kelamin' => JenisKelamin::LakiLaki,
                            'tempat_lahir' => 'Garut',
                            'tanggal_lahir' => now()->subYears(68),
                            'hubungan_keluarga' => HubunganKeluarga::OrangTua,
                            'pekerjaan' => 'Pensiunan',
                            'pendidikan' => 'SD/Sederajat',
                            'status_kependudukan' => StatusKependudukan::Tetap,
                            'status_hidup' => 'hidup',
                            'tanggal_terdaftar' => now()->subYears(10),
                        ]
                    );

                    PemantauanKesehatan::firstOrCreate(
                        ['penduduk_id' => $lansia->id, 'kategori' => KategoriPemantauan::LansiaRentan->value, 'aktif' => true],
                        [
                            'wilayah_id' => $rt->id,
                            'status_risiko' => TingkatRisikoKesehatan::Normal,
                            'tanggal_mulai' => now()->subMonths(3)->toDateString(),
                            'catatan_tindakan' => 'Pemeriksaan tensi rutin Posbindu PTM.',
                            'dicatat_oleh' => $kader?->id,
                        ]
                    );
                }
            }
        }

        // Seed verified LAMPID historical events & pending RT reports
        $firstRt = $rts->first();
        $firstPenduduk = Penduduk::where('wilayah_id', $firstRt->id)->first();
        $firstKk = KartuKeluarga::where('wilayah_id', $firstRt->id)->first();

        MutasiPenduduk::firstOrCreate(
            ['nomor_surat_pengantar' => 'SKD-SKW-'.now()->year.'-00101'],
            [
                'wilayah_id' => $firstRt->id,
                'penduduk_id' => $firstPenduduk?->id,
                'kartu_keluarga_id' => $firstKk?->id,
                'jenis_mutasi' => JenisMutasi::Datang,
                'tanggal_peristiwa' => now()->subDays(12)->toDateString(),
                'asal_atau_tujuan' => 'Kecamatan Coblong, Kota Bandung',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
                'diajukan_oleh' => $rtUser?->id,
                'diverifikasi_oleh' => $operator?->id,
                'diverifikasi_pada' => now()->subDays(11),
                'disinkronkan_pada' => now()->subDays(11),
                'catatan_verifikasi' => 'SKDWNI lengkap diverifikasi oleh loket.',
            ]
        );

        MutasiPenduduk::firstOrCreate(
            ['nomor_surat_pengantar' => 'SKL-SKW-'.now()->year.'-00102'],
            [
                'wilayah_id' => $firstRt->id,
                'penduduk_id' => $firstPenduduk?->id,
                'kartu_keluarga_id' => $firstKk?->id,
                'jenis_mutasi' => JenisMutasi::Kelahiran,
                'tanggal_peristiwa' => now()->subDays(6)->toDateString(),
                'asal_atau_tujuan' => 'RSIA Limijati Bandung',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
                'diajukan_oleh' => $kader?->id,
                'diverifikasi_oleh' => $operator?->id,
                'diverifikasi_pada' => now()->subDays(5),
                'disinkronkan_pada' => now()->subDays(5),
                'catatan_verifikasi' => 'Surat keterangan lahir diverifikasi dan dicatat pada BIP.',
            ]
        );

        // Pending mutation report submitted by Ketua RW 01 ready for Operator action
        if (! MutasiPenduduk::where('status_verifikasi', StatusVerifikasi::Diajukan->value)->exists()) {
            MutasiPenduduk::create([
                'wilayah_id' => $firstRt->id,
                'jenis_mutasi' => JenisMutasi::Datang,
                'tanggal_peristiwa' => now()->subDay()->toDateString(),
                'asal_atau_tujuan' => 'Kabupaten Sumedang (Pendatang Sementara)',
                'payload_data' => [
                    'no_kk' => '3211021205950099',
                    'kepala_keluarga_nama' => 'Fajar Maulana',
                    'nik' => '3211021205950098',
                    'nama_lengkap' => 'Fajar Maulana',
                    'jenis_kelamin' => JenisKelamin::LakiLaki->value,
                    'tanggal_lahir' => '1995-05-12',
                    'status_kependudukan' => StatusKependudukan::Sementara->value,
                    'pekerjaan' => 'Karyawan Swasta',
                ],
                'status_verifikasi' => StatusVerifikasi::Diajukan,
                'diajukan_oleh' => $rtUser?->id,
                'catatan_verifikasi' => 'Pengajuan surat domisili sementara dari Ketua RW 01.',
            ]);
        }

        // Sync real-time demographic aggregates bottom-up once per node (RT -> RW -> Kelurahan)
        $kelurahan = Wilayah::where('kode', '32.73.01.1001')->first();
        if ($kelurahan) {
            app(DemografiSyncService::class)->syncTree($kelurahan->id);
        }
    }
}
