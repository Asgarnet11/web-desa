<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PengaduanTerbaruWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 2,
    ];

    protected static ?string $heading = 'Aspirasi & Pengaduan Warga Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pengaduan::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->fontFamily('mono')
                    ->copyable()
                    ->sortable(),
                TextColumn::make('nama_pelapor')
                    ->label('Nama Warga')
                    ->limit(18),
                TextColumn::make('kategori')
                    ->badge(),
                TextColumn::make('judul')
                    ->label('Perihal Laporan')
                    ->limit(35),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('tinjau')
                    ->label('Tindak Lanjut')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Pengaduan $record): string => route('filament.admin.resources.pengaduans.edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
