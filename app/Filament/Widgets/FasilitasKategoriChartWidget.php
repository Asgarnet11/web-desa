<?php

namespace App\Filament\Widgets;

use App\Models\KategoriFasilitas;
use Filament\Widgets\ChartWidget;

class FasilitasKategoriChartWidget extends ChartWidget
{
    protected ?string $heading = 'Distribusi Kategori Fasilitas Publik';

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '280px';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $kategori = KategoriFasilitas::withCount(['fasilitas' => fn ($q) => $q->where('is_publik', true)])->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Fasilitas',
                    'data' => $kategori->pluck('fasilitas_count')->toArray(),
                    'backgroundColor' => $kategori->map(fn ($k) => $k->warna ?? '#2D6A4F')->toArray(),
                ],
            ],
            'labels' => $kategori->pluck('nama')->toArray(),
        ];
    }
}
