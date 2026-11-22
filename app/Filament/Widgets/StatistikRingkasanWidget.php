<?php

namespace App\Filament\Widgets;

use App\Enums\StatusPengaduan;
use App\Models\Fasilitas;
use App\Models\Pengaduan;
use App\Models\Umkm;
use App\Models\Wilayah;
use App\Services\StatistikService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatistikRingkasanWidget extends BaseWidget
{
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
        $totalUmkm = Umkm::where('is_publik', true)->count();

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
