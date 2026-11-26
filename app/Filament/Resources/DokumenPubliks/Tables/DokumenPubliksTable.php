<?php

namespace App\Filament\Resources\DokumenPubliks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DokumenPubliksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul Dokumen')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Formulir' => 'success',
                        'SOP' => 'info',
                        'Laporan' => 'warning',
                        'Peraturan' => 'primary',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('ukuran_file')
                    ->label('Ukuran / Format')
                    ->searchable(),
                TextColumn::make('download_count')
                    ->label('Diunduh')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Unggah')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
