<?php

namespace App\Filament\Widgets;

use App\Models\KategoriFasilitas;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class FasilitasKategoriChartWidget extends ChartWidget
{
    protected static bool $isLazy = false;

    protected ?string $heading = 'Sebaran Fasilitas Publik';

    protected ?string $description = 'Jumlah titik sarana publik terverifikasi per kategori.';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 1,
    ];

    protected ?string $maxHeight = '290px';

    public static function canView(): bool
    {
        return ! (Auth::user()?->isPetugasLapangan() ?? false);
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $kategori = KategoriFasilitas::withCount(['fasilitas' => fn ($q) => $q->where('is_publik', true)])
            ->orderByDesc('fasilitas_count')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Titik Fasilitas',
                    'data' => $kategori->pluck('fasilitas_count')->toArray(),
                    'backgroundColor' => '#1B4332',
                    'borderRadius' => 4,
                    'barThickness' => 16,
                ],
            ],
            'labels' => $kategori->pluck('nama')->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                        'stepSize' => 1,
                    ],
                    'grid' => [
                        'color' => 'rgba(148, 163, 184, 0.18)',
                    ],
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
