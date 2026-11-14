<?php

namespace App\Filament\Resources\Demografis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemografisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('wilayah.id')
                    ->searchable(),
                TextColumn::make('periode')
                    ->searchable(),
                TextColumn::make('jumlah_penduduk')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_kk')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('laki_laki')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('perempuan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_verifikasi')
                    ->badge()
                    ->searchable(),
                TextColumn::make('diverifikasi_oleh')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diverifikasi_pada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
