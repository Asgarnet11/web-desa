<?php

namespace App\Filament\Resources\LogAktivitas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LogAktivitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu Aktivitas')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Petugas / User')
                    ->searchable()
                    ->default('Sistem / Tamu'),
                TextColumn::make('aksi')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tambah', 'create' => 'success',
                        'ubah', 'update' => 'info',
                        'hapus', 'delete' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('entitas')
                    ->label('Entitas')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
                TextColumn::make('entitas_id')
                    ->label('ID Target')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('Alamat IP')
                    ->searchable()
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
