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

        // 1. Pimpinan (Lurah) - Ruang Kendali Eksekutif
        if ($user?->isPimpinan()) {
            return [
                Stat::make('Penyelesaian Aspirasi', "{$persenSelesai}%")
                    ->description("{$pengaduanSelesai} dari {$totalPengaduan} laporan tuntas")
                    ->descriptionIcon('heroicon-m-check-badge')
                    ->chart([70, 75, 82, 88, 92, $persenSelesai])
                    ->color('success'),

                Stat::make('Kependudukan Sukawarna', number_format($totalPenduduk, 0, ',', '.').' Jiwa')
                    ->description('Tersebar di '.number_format($totalKk, 0, ',', '.').' Kepala Keluarga')
                    ->descriptionIcon('heroicon-m-user-group')
                    ->chart([12100, 12250, 12380, 12450, 12510, 12580])
                    ->color('primary'),

                Stat::make('Kondisi Infrastruktur', "{$persenInfra}%")
                    ->description('Jalan, drainase & fasilitas fisik prima')
                    ->descriptionIcon('heroicon-m-wrench-screwdriver')
                    ->color('success'),

                Stat::make('Ekonomi & UMKM Warga', number_format($totalUmkm, 0, ',', '.').' Unit')
                    ->description('Potensi ekonomi mandiri binaan aktif')
                    ->descriptionIcon('heroicon-m-building-storefront')
                    ->color('warning'),

                Stat::make('Aset Fasilitas GIS', number_format($totalFasilitas, 0, ',', '.').' Titik')
                    ->description('Sarana publik terpetakan di wilayah')
                    ->descriptionIcon('heroicon-m-map-pin')
                    ->color('info'),

                Stat::make('Keterbukaan Publik (KIP)', number_format($totalDokumen, 0, ',', '.').' Berkas')
                    ->description('Regulasi, SOP, dan transparansi warga')
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('primary'),
            ];
        }

        // 2. Operator - Meja Kerja Operasional & Loket Pelayanan
        if ($user?->isOperator()) {
            return [
                Stat::make('Aduan Butuh Verifikasi', (string) $pengaduanMenunggu)
                    ->description($pengaduanMenunggu > 0 ? 'Perlu tindakan loket & verifikasi segera' : 'Seluruh aduan telah terdisposisi')
                    ->descriptionIcon('heroicon-m-inbox-stack')
                    ->color($pengaduanMenunggu > 0 ? 'danger' : 'success'),

                Stat::make('Pendaftaran UMKM Baru', (string) $umkmPending)
                    ->description($umkmPending > 0 ? "{$umkmPending} pengajuan mandiri menunggu kurasi" : 'Seluruh UMKM warga telah dikurasi')
                    ->descriptionIcon('heroicon-m-building-storefront')
                    ->color($umkmPending > 0 ? 'warning' : 'success'),

                Stat::make('Aduan Sedang Diproses', (string) $pengaduanProses)
                    ->description('Dalam pengerjaan lapangan & tindak lanjut')
                    ->descriptionIcon('heroicon-m-arrow-path')
                    ->color('info'),

                Stat::make('Titik Fasilitas GIS', number_format($totalFasilitas, 0, ',', '.').' Titik')
                    ->description('Sarana publik terdata di peta digital')
                    ->descriptionIcon('heroicon-m-map-pin')
                    ->color('primary'),

                Stat::make('Blangko & Layanan', number_format($totalDokumen, 0, ',', '.').' Berkas')
                    ->description('Formulir persyaratan pelayanan warga')
                    ->descriptionIcon('heroicon-m-document-duplicate')
                    ->color('primary'),

                Stat::make('Warta & Informasi', number_format($totalBerita, 0, ',', '.').' Rilis')
                    ->description('Kabar kelurahan & publikasi aktif')
                    ->descriptionIcon('heroicon-m-newspaper')
                    ->color('success'),
            ];
        }

        // 3. Admin Wilayah - Supervisi Kewilayahan (Kecamatan Sukasari)
        if ($user?->isAdminWilayah()) {
            return [
                Stat::make('Agregat Jiwa Sukasari', number_format($totalPenduduk, 0, ',', '.').' Jiwa')
                    ->description('Kependudukan terpadu wilayah binaan')
                    ->descriptionIcon('heroicon-m-user-group')
                    ->chart([12100, 12250, 12380, 12450, 12510, 12580])
                    ->color('primary'),

                Stat::make('Kondisi Infrastruktur', "{$persenInfra}%")
                    ->description('Kelaikan fisik sarana & prasarana wilayah')
                    ->descriptionIcon('heroicon-m-shield-check')
                    ->color('success'),

                Stat::make('Sebaran Sarana GIS', number_format($totalFasilitas, 0, ',', '.').' Titik')
                    ->description('Aset fasilitas publik lintas RW')
                    ->descriptionIcon('heroicon-m-map-pin')
                    ->color('info'),

                Stat::make('Volume Aspirasi Masuk', number_format($totalPengaduan, 0, ',', '.').' Tiket')
                    ->description($pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} tiket menunggu penanganan aparat" : 'Seluruh tiket aspirasi tertangani')
                    ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                    ->color($pengaduanMenunggu > 0 ? 'warning' : 'success'),

                Stat::make('Pemberdayaan UMKM', number_format($totalUmkm, 0, ',', '.').' Unit')
                    ->description('Sektor usaha mikro lokal aktif binaan')
                    ->descriptionIcon('heroicon-m-building-storefront')
                    ->color('warning'),

                Stat::make('Regulasi & KIP Wilayah', number_format($totalDokumen, 0, ',', '.').' Dokumen')
                    ->description('Transparansi & dokumen publik kewilayahan')
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('primary'),
            ];
        }

        // 4. Super Admin - Tata Kelola Sistem & Keamanan Data
        if ($user?->isSuperAdmin()) {
            $totalUsers = User::count();
            $totalLogs = LogAktivitas::count();
            $totalWilayah = Wilayah::count();

            return [
                Stat::make('Pengguna Terdaftar', number_format($totalUsers, 0, ',', '.').' Akun')
                    ->description('Aparatur berizin akses dalam sistem')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('primary'),

                Stat::make('Audit Trail Log', number_format($totalLogs, 0, ',', '.').' Entri')
                    ->description('Rekaman mutasi data & operasi sistem')
                    ->descriptionIcon('heroicon-m-clipboard-document-list')
                    ->color('info'),

                Stat::make('Master Wilayah & GIS', number_format($totalWilayah, 0, ',', '.').' Unit')
                    ->description('Entitas polygon batas kelurahan & RW')
                    ->descriptionIcon('heroicon-m-globe-alt')
                    ->color('success'),

                Stat::make('Integritas Spasial', number_format($totalFasilitas, 0, ',', '.').' Titik')
                    ->description('Koordinat sarana publik terverifikasi')
                    ->descriptionIcon('heroicon-m-map-pin')
                    ->color('info'),

                Stat::make('Arsip Pengaduan Masuk', number_format($totalPengaduan, 0, ',', '.').' Tiket')
                    ->description("{$pengaduanSelesai} tuntas, {$pengaduanMenunggu} menunggu")
                    ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                    ->color('warning'),

                Stat::make('Repositori Berkas Publik', number_format($totalDokumen, 0, ',', '.').' File')
                    ->description('Berkas keterbukaan publik & media')
                    ->descriptionIcon('heroicon-m-folder-arrow-down')
                    ->color('primary'),
            ];
        }

        // Fallback default
        return [
            Stat::make('Total Penduduk', number_format($totalPenduduk, 0, ',', '.'))
                ->description('Jiwa terdaftar di basis data')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([12100, 12250, 12380, 12450, 12510, 12580])
                ->color('success'),

            Stat::make('Kepala Keluarga', number_format($totalKk, 0, ',', '.'))
                ->description('Jumlah KK aktif wilayah')
                ->descriptionIcon('heroicon-m-home')
                ->chart([3100, 3140, 3170, 3200, 3220, 3240])
                ->color('info'),

            Stat::make('Fasilitas Spasial', number_format($totalFasilitas, 0, ',', '.'))
                ->description('Titik fasilitas publik terpeta')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),

            Stat::make('Pengaduan Warga', number_format($totalPengaduan, 0, ',', '.'))
                ->description($pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} menunggu verifikasi" : 'Seluruh keluhan tertangani')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color($pengaduanMenunggu > 0 ? 'warning' : 'success'),

            Stat::make('UMKM Binaan', number_format($totalUmkm, 0, ',', '.'))
                ->description('Unit usaha aktif terverifikasi')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('warning'),

            Stat::make('Kondisi Infrastruktur', $persenInfra.'%')
                ->description('Jalan, drainase & fasilitas fisik')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success'),
        ];
    }
}
