<?php

namespace App\Filament\Widgets;

use App\Enums\KategoriPemantauan;
use App\Enums\StatusPengaduan;
use App\Enums\StatusVerifikasi;
use App\Enums\TingkatRisikoKesehatan;
use App\Enums\TipeWilayah;
use App\Models\DokumenPublik;
use App\Models\Fasilitas;
use App\Models\KartuKeluarga;
use App\Models\LogAktivitas;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
use App\Models\Penduduk;
use App\Models\Pengaduan;
use App\Models\Umkm;
use App\Models\User;
use App\Models\Wilayah;
use App\Services\StatistikService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatistikRingkasanWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $user = Auth::user();
        $wilayahId = $user?->wilayah_id;

        if (! $wilayahId || $user?->isAdminWilayah()) {
            $wilayahId = Wilayah::where('tipe', TipeWilayah::Kelurahan->value)->first()?->id ?? Wilayah::first()?->id;
        }

        if (! $wilayahId) {
            return [];
        }

        $statistikService = app(StatistikService::class);
        $ringkasan = $statistikService->getRingkasanWilayah($wilayahId);

        $totalPenduduk = $ringkasan['demografi']['total_penduduk'] ?? 0;
        $totalKk = $ringkasan['demografi']['total_kk'] ?? 0;
        $rincian = $ringkasan['demografi']['rincian'] ?? [];
        $kesehatanRincian = $rincian['kesehatan_keluarga'] ?? [];
        $mutasiRincian = $rincian['mutasi_tahun_ini'] ?? [];

        $totalFasilitas = Fasilitas::where('is_publik', true)->count();
        $persenInfra = $ringkasan['infrastruktur']['persentase_baik'] ?? 100;

        $totalPengaduan = Pengaduan::count();
        $pengaduanMenunggu = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pengaduanSelesai = Pengaduan::where('status', StatusPengaduan::Selesai)->count();
        $persenSelesai = $totalPengaduan > 0 ? (int) round(($pengaduanSelesai / $totalPengaduan) * 100) : 100;

        $totalUmkm = Umkm::where('is_publik', true)->count();
        $umkmPending = Umkm::where('is_publik', false)->count();
        $totalDokumen = DokumenPublik::count();
        $mutasiPending = MutasiPenduduk::forCurrentUserWilayah()->where('status_verifikasi', StatusVerifikasi::Diajukan->value)->count();

        // 1. Pimpinan (Lurah) - Ruang Kendali Eksekutif (Agregat Real-Time + Kesehatan Anonim)
        if ($user?->isPimpinan()) {
            $bumilCount = (int) ($kesehatanRincian['ibu_hamil'] ?? 0);
            $bumilResti = (int) ($kesehatanRincian['ibu_hamil_risiko'] ?? 0);

            return [
                Stat::make('Penduduk Aktif Wilayah', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                    ->description(number_format($totalKk, 0, ',', '.').' kepala keluarga · +'.($mutasiRincian['kelahiran'] ?? 0).' lahir / +'.($mutasiRincian['datang'] ?? 0).' datang')
                    ->color('gray'),

                Stat::make('Ibu Hamil Terpantau', "{$bumilCount} jiwa")
                    ->description($bumilResti > 0 ? "{$bumilResti} berisiko KEK/Resti (Posyandu aktif)" : 'Kondisi terpantau aman di Posyandu')
                    ->color($bumilResti > 0 ? 'warning' : 'success'),

                Stat::make('Penyelesaian Aspirasi', "{$persenSelesai}%")
                    ->description("{$pengaduanSelesai} dari {$totalPengaduan} aduan warga selesai")
                    ->color($persenSelesai >= 75 ? 'success' : 'warning'),

                Stat::make('Infrastruktur & Sarana', "{$persenInfra}% baik")
                    ->description("{$totalFasilitas} sarana GIS · {$totalUmkm} UMKM aktif")
                    ->color('gray'),
            ];
        }

        // 2. Operator - Antrean Verifikasi Adminduk, Aduan & UMKM
        if ($user?->isOperator()) {
            return [
                Stat::make('Mutasi LAMPID Menunggu', (string) $mutasiPending)
                    ->description($mutasiPending > 0 ? 'Laporan RT/RW menunggu pengesahan loket' : 'Semua mutasi warga telah tersinkron')
                    ->color($mutasiPending > 0 ? 'warning' : 'success'),

                Stat::make('Antrean Verifikasi Aduan', (string) $pengaduanMenunggu)
                    ->description($pengaduanMenunggu > 0 ? 'Tiket masuk menunggu pemeriksaan loket' : 'Semua aduan telah terdisposisi')
                    ->color($pengaduanMenunggu > 0 ? 'danger' : 'success'),

                Stat::make('Kurasi UMKM Baru', (string) $umkmPending)
                    ->description($umkmPending > 0 ? 'Pengajuan mandiri menunggu verifikasi' : 'Seluruh profil UMKM terverifikasi')
                    ->color($umkmPending > 0 ? 'warning' : 'success'),

                Stat::make('Penduduk Induk Aktif', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                    ->description(number_format($totalKk, 0, ',', '.').' KK · '.number_format($totalDokumen).' berkas KIP')
                    ->color('gray'),
            ];
        }

        // 3. Ketua RT / RW - Statistik Lingkup RT/RW Binaan
        if ($user?->isKetuaRtRw()) {
            $wargaWilayah = Penduduk::forCurrentUserWilayah()->aktif()->count();
            $kkWilayah = KartuKeluarga::forCurrentUserWilayah()->where('status_kk', 'aktif')->count();
            $mutasiDisahkan = MutasiPenduduk::forCurrentUserWilayah()->where('status_verifikasi', StatusVerifikasi::Terverifikasi->value)->count();

            return [
                Stat::make('Warga Wilayah Binaan', number_format($wargaWilayah, 0, ',', '.').' jiwa')
                    ->description('Penduduk aktif tercatat dalam RT/RW Anda')
                    ->color('gray'),

                Stat::make('Kepala Keluarga Aktif', number_format($kkWilayah, 0, ',', '.').' KK')
                    ->description('Kartu Keluarga terdata pada sistem')
                    ->color('gray'),

                Stat::make('Laporan Mutasi Menunggu', (string) $mutasiPending)
                    ->description($mutasiPending > 0 ? 'Sedang diverifikasi oleh Operator Kelurahan' : 'Belum ada pengajuan tertunda')
                    ->color($mutasiPending > 0 ? 'warning' : 'success'),

                Stat::make('Mutasi Telah Disahkan', (string) $mutasiDisahkan)
                    ->description('Peristiwa kelahiran, datang & pindah teregistrasi')
                    ->color('success'),
            ];
        }

        // 4. Kader Kesehatan / Posyandu - Fokus Bumil, Balita & Lansia
        if ($user?->isKaderKesehatan()) {
            $kesehatanAktif = PemantauanKesehatan::forCurrentUserWilayah()->sedangAktif()->get();
            $bumilTotal = $kesehatanAktif->where('kategori', KategoriPemantauan::IbuHamil)->count();
            $bumilResti = $kesehatanAktif->where('kategori', KategoriPemantauan::IbuHamil)->whereIn('status_risiko', [TingkatRisikoKesehatan::Kek, TingkatRisikoKesehatan::RisikoTinggi])->count();
            $balitaTotal = $kesehatanAktif->where('kategori', KategoriPemantauan::BalitaGizi)->count();
            $lansiaTotal = $kesehatanAktif->where('kategori', KategoriPemantauan::LansiaRentan)->count();

            return [
                Stat::make('Ibu Hamil Aktif', "{$bumilTotal} jiwa")
                    ->description('Sasaran pemantauan KIA wilayah Sukawarna')
                    ->color('gray'),

                Stat::make('Ibu Hamil Resti / KEK', "{$bumilResti} jiwa")
                    ->description($bumilResti > 0 ? 'Memerlukan pendampingan gizi & jadwal kontrol' : 'Tidak ada risiko tinggi tercatat')
                    ->color($bumilResti > 0 ? 'danger' : 'success'),

                Stat::make('Balita Pantauan Gizi', "{$balitaTotal} anak")
                    ->description('Tercatat aktif di buku Posyandu kelurahan')
                    ->color('gray'),

                Stat::make('Lansia Rentan Terdata', "{$lansiaTotal} jiwa")
                    ->description('Sasaran kunjungan kesehatan kelurahan')
                    ->color('gray'),
            ];
        }

        // 5. Admin Wilayah - Supervisi Kecamatan Sukasari (Agregat Non-PII)
        if ($user?->isAdminWilayah()) {
            return [
                Stat::make('Agregat Jiwa Sukasari', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                    ->description(number_format($totalKk, 0, ',', '.').' kepala keluarga · agregat kelurahan')
                    ->color('gray'),

                Stat::make('Kelaikan Infrastruktur', "{$persenInfra}%")
                    ->description('Kondisi jalan, drainase & fasilitas RW')
                    ->color('success'),

                Stat::make('Sebaran Sarana GIS', number_format($totalFasilitas, 0, ',', '.').' titik')
                    ->description("{$totalUmkm} unit UMKM aktif lintas wilayah")
                    ->color('gray'),

                Stat::make('Volume Aspirasi Wilayah', number_format($totalPengaduan, 0, ',', '.').' tiket')
                    ->description($pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} menunggu tindak lanjut" : 'Seluruh tiket tertangani')
                    ->color($pengaduanMenunggu > 0 ? 'warning' : 'success'),
            ];
        }

        // 6. Super Admin - Tata Kelola & Keamanan
        if ($user?->isSuperAdmin()) {
            $totalUsers = User::count();
            $totalLogs = LogAktivitas::count();
            $totalWilayah = Wilayah::count();

            return [
                Stat::make('Akun Aparatur Aktif', number_format($totalUsers, 0, ',', '.').' akun')
                    ->description('Hak akses terkelola berbasis peran')
                    ->color('gray'),

                Stat::make('Rekaman Audit Trail', number_format($totalLogs, 0, ',', '.').' entri')
                    ->description('Redaksi otomatis NIK/No. KK sesuai UU PDP')
                    ->color('gray'),

                Stat::make('Master Wilayah GeoJSON', number_format($totalWilayah, 0, ',', '.').' entitas')
                    ->description("{$totalFasilitas} titik sarana · ".number_format($totalPenduduk, 0, ',', '.').' penduduk terdata')
                    ->color('success'),

                Stat::make('Antrean Verifikasi', (string) ($mutasiPending + $pengaduanMenunggu))
                    ->description("{$mutasiPending} mutasi LAMPID · {$pengaduanMenunggu} aduan terbuka")
                    ->color(($mutasiPending + $pengaduanMenunggu) > 0 ? 'warning' : 'gray'),
            ];
        }

        return [];
    }
}
