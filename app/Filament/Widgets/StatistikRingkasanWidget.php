<?php

namespace App\Filament\Widgets;

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

        $totalPenduduk = $ringkasan['demografi']['total_penduduk'] ?? 0;
        $totalKk = $ringkasan['demografi']['total_kk'] ?? 0;
        $totalFasilitas = $ringkasan['fasilitas']['total'] ?? 0;
        $persenInfra = $ringkasan['infrastruktur']['persentase_baik'] ?? 100;

        return [
            Stat::make('Total Penduduk', number_format($totalPenduduk, 0, ',', '.'))
                ->description('Jiwa terdaftar di basis data')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Kepala Keluarga', number_format($totalKk, 0, ',', '.'))
                ->description('Jumlah KK aktif')
                ->descriptionIcon('heroicon-m-home')
                ->color('info'),

            Stat::make('Fasilitas Umum', number_format($totalFasilitas, 0, ',', '.'))
                ->description('Titik fasilitas publik terpeta')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('warning'),

            Stat::make('Infrastruktur Baik', $persenInfra.'%')
                ->description('Jalan, jembatan, dan drainase')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('primary'),
        ];
    }
}
