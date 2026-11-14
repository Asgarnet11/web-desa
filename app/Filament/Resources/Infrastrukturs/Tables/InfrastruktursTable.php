<?php

namespace App\Filament\Resources\Infrastrukturs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InfrastruktursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('wilayah.id')
                    ->searchable(),
                TextColumn::make('jenis')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('volume_kapasitas')
                    ->searchable(),
                TextColumn::make('kondisi')
                    ->badge()
                    ->searchable(),
                TextColumn::make('periode')
                    ->searchable(),
                TextColumn::make('status_verifikasi')
                    ->badge()
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
