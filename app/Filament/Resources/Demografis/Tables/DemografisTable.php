<?php

namespace App\Filament\Resources\Demografis\Tables;

use App\Enums\StatusVerifikasi;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemografisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('periode', 'desc')
            ->columns([
                TextColumn::make('wilayah.breadcrumb_nama')
                    ->label('Wilayah (Kelurahan / RW / RT)')
                    ->weight('semibold'),
                TextColumn::make('periode')
                    ->label('Periode')
                    ->fontFamily('mono')
                    ->searchable(),
                TextColumn::make('jumlah_penduduk')
                    ->label('Penduduk')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_kk')
                    ->label('Jumlah KK')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('laki_laki')
                    ->label('Laki-laki')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('perempuan')
                    ->label('Perempuan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rincian.kesehatan_keluarga.ibu_hamil')
                    ->label('Ibu Hamil')
                    ->default('0'),
                TextColumn::make('status_verifikasi')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof StatusVerifikasi ? $state->label() : (string) $state)
                    ->color(fn ($state) => $state instanceof StatusVerifikasi ? $state->color() : 'gray'),
                TextColumn::make('diverifikasi_pada')
                    ->label('Sinkron Terakhir')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
