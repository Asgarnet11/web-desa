<?php

namespace App\Filament\Resources\KartuKeluargas\Tables;

use App\Support\KependudukanSecurity;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KartuKeluargasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('no_kk_tersamar')
                    ->label('No. KK (Tersamar UU PDP)')
                    ->fontFamily('mono')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('no_kk_hash', KependudukanSecurity::hashIdentifier($search))
                            ->orWhere('kepala_keluarga_nama', 'like', "%{$search}%");
                    }),
                TextColumn::make('kepala_keluarga_nama')
                    ->label('Kepala Keluarga')
                    ->weight('semibold')
                    ->searchable(),
                TextColumn::make('wilayah.breadcrumb_nama')
                    ->label('Wilayah RT / RW'),
                TextColumn::make('anggota_count')
                    ->counts('anggota')
                    ->label('Anggota')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_kk')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'pindah' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_kk')
                    ->label('Status KK')
                    ->options([
                        'aktif' => 'Aktif',
                        'pindah' => 'Pindah Keluar',
                        'nonaktif' => 'Nonaktif',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
