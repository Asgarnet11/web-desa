<?php

namespace App\Filament\Widgets;

use App\Enums\StatusPengaduan;
use App\Models\Berita;
use App\Models\DokumenPublik;
use App\Models\Fasilitas;
use App\Models\LogAktivitas;
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

        if (! $wilayahId) {
            $wilayahId = Wilayah::where('tipe', 'kelurahan')->first()?->id ?? Wilayah::first()?->id;
        }

        if (! $wilayahId) {
            return [];
        }

        $statistikService = app(StatistikService::class);
        $ringkasan = $statistikService->getRingkasanWilayah($wilayahId);

        $totalPenduduk = $ringkasan['demografi']['total_penduduk'] ?? 12580;
        $totalKk = $ringkasan['demografi']['total_kk'] ?? 3240;
        $totalFasilitas = Fasilitas::where('is_publik', true)->count();
        $persenInfra = $ringkasan['infrastruktur']['persentase_baik'] ?? 94;

        $totalPengaduan = Pengaduan::count();
        $pengaduanMenunggu = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pengaduanProses = Pengaduan::where('status', StatusPengaduan::Diproses)->count();
        $pengaduanSelesai = Pengaduan::where('status', StatusPengaduan::Selesai)->count();
        $persenSelesai = $totalPengaduan > 0 ? (int) round(($pengaduanSelesai / $totalPengaduan) * 100) : 100;

        $totalUmkm = Umkm::where('is_publik', true)->count();
        $umkmPending = Umkm::where('is_publik', false)->count();
        $totalDokumen = DokumenPublik::count();
        $totalBerita = Berita::count();

        // 1. Pimpinan (Lurah) - Ruang Kendali Eksekutif (4 KPI seimbang)
        if ($user?->isPimpinan()) {
            return [
                Stat::make('Penyelesaian Aspirasi', "{$persenSelesai}%")
                    ->description("{$pengaduanSelesai} dari {$totalPengaduan} laporan selesai")
                    ->color($persenSelesai >= 75 ? 'success' : 'warning'),

                Stat::make('Penduduk Terdaftar', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                    ->description(number_format($totalKk, 0, ',', '.').' kepala keluarga aktif')
                    ->color('gray'),

                Stat::make('Kondisi Infrastruktur', "{$persenInfra}%")
                    ->description('Prasarana fisik berkondisi baik')
                    ->color('success'),

                Stat::make('UMKM & Sarana GIS', number_format($totalUmkm, 0, ',', '.').' unit')
                    ->description("{$totalFasilitas} titik sarana · {$totalDokumen} dokumen KIP")
                    ->color('gray'),
            ];
        }

        // 2. Operator - Antrean Kerja Pelayanan Warga (4 KPI seimbang)
        if ($user?->isOperator()) {
            return [
                Stat::make('Antrean Verifikasi Aduan', (string) $pengaduanMenunggu)
                    ->description($pengaduanMenunggu > 0 ? 'Tiket masuk menunggu pemeriksaan loket' : 'Semua aduan telah terdisposisi')
                    ->color($pengaduanMenunggu > 0 ? 'danger' : 'success'),

                Stat::make('Kurasi UMKM Baru', (string) $umkmPending)
                    ->description($umkmPending > 0 ? 'Pengajuan mandiri menunggu verifikasi' : 'Seluruh profil UMKM terverifikasi')
                    ->color($umkmPending > 0 ? 'warning' : 'success'),

                Stat::make('Aduan Dalam Penanganan', (string) $pengaduanProses)
                    ->description("{$pengaduanSelesai} aduan tuntas dari total {$totalPengaduan}")
                    ->color('gray'),

                Stat::make('Data Spasial & Publikasi', number_format($totalFasilitas, 0, ',', '.').' titik')
                    ->description("{$totalBerita} warta terbit · {$totalDokumen} blangko layanan")
                    ->color('gray'),
            ];
        }

        // 3. Admin Wilayah - Supervisi Kewilayahan (4 KPI seimbang)
        if ($user?->isAdminWilayah()) {
            return [
                Stat::make('Agregat Jiwa Sukasari', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                    ->description(number_format($totalKk, 0, ',', '.').' kepala keluarga tercatat')
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

        // 4. Super Admin - Tata Kelola & Keamanan (4 KPI seimbang)
        if ($user?->isSuperAdmin()) {
            $totalUsers = User::count();
            $totalLogs = LogAktivitas::count();
            $totalWilayah = Wilayah::count();

            return [
                Stat::make('Akun Aparatur Aktif', number_format($totalUsers, 0, ',', '.').' akun')
                    ->description('Hak akses terkelola berbasis peran')
                    ->color('gray'),

                Stat::make('Rekaman Audit Trail', number_format($totalLogs, 0, ',', '.').' entri')
                    ->description('Pencatatan mutasi & aktivitas sistem')
                    ->color('gray'),

                Stat::make('Master Wilayah GeoJSON', number_format($totalWilayah, 0, ',', '.').' entitas')
                    ->description("{$totalFasilitas} koordinat sarana publik terpetakan")
                    ->color('success'),

                Stat::make('Arsip Aduan & Berkas', number_format($totalPengaduan, 0, ',', '.').' tiket')
                    ->description("{$totalDokumen} dokumen publik di repositori")
                    ->color('gray'),
            ];
        }

        return [
            Stat::make('Total Penduduk', number_format($totalPenduduk, 0, ',', '.').' jiwa')
                ->description(number_format($totalKk, 0, ',', '.').' kepala keluarga')
                ->color('gray'),

            Stat::make('Fasilitas Spasial', number_format($totalFasilitas, 0, ',', '.').' titik')
                ->description('Titik sarana publik terpetakan')
                ->color('gray'),

            Stat::make('Pengaduan Warga', number_format($totalPengaduan, 0, ',', '.').' tiket')
                ->description($pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} menunggu verifikasi" : 'Seluruh aduan tertangani')
                ->color($pengaduanMenunggu > 0 ? 'warning' : 'success'),

            Stat::make('Kondisi Infrastruktur', "{$persenInfra}%")
                ->description("{$totalUmkm} UMKM binaan aktif")
                ->color('success'),
        ];
    }
}
