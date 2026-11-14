<?php

namespace App\Filament\Resources\ProfilKelurahans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilKelurahansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('wilayah.id')
                    ->searchable(),
                TextColumn::make('slogan')
                    ->searchable(),
                TextColumn::make('tahun_terbentuk')
                    ->searchable(),
                TextColumn::make('motto_pelayanan')
                    ->searchable(),
                TextColumn::make('foto_kantor')
                    ->searchable(),
                TextColumn::make('foto_peta_wilayah')
                    ->searchable(),
                TextColumn::make('batas_utara')
                    ->searchable(),
                TextColumn::make('batas_selatan')
                    ->searchable(),
                TextColumn::make('batas_timur')
                    ->searchable(),
                TextColumn::make('batas_barat')
                    ->searchable(),
                TextColumn::make('kontak_telepon')
                    ->searchable(),
                TextColumn::make('kontak_whatsapp')
                    ->searchable(),
                TextColumn::make('kontak_email')
                    ->searchable(),
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
