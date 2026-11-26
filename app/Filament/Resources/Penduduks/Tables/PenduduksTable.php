<?php

namespace App\Filament\Resources\Penduduks\Tables;

use App\Enums\JenisKelamin;
use App\Enums\StatusKependudukan;
use App\Models\Penduduk;
use App\Support\KependudukanSecurity;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PenduduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('nik_tersamar')
                    ->label('NIK (Tersamar)')
                    ->fontFamily('mono')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('nik_hash', KependudukanSecurity::hashIdentifier($search))
                            ->orWhere('nama_lengkap', 'like', "%{$search}%");
                    }),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->weight('semibold')
                    ->searchable(),
                TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->formatStateUsing(fn ($state) => $state instanceof JenisKelamin ? $state->value : (string) $state),
                TextColumn::make('usia')
                    ->label('Usia')
                    ->state(fn (Penduduk $record): string => "{$record->usia} thn"),
                TextColumn::make('wilayah.breadcrumb_nama')
                    ->label('RT / RW'),
                TextColumn::make('kartuKeluarga.kepala_keluarga_nama')
                    ->label('Kepala KK')
                    ->placeholder('—'),
                TextColumn::make('status_kependudukan')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof StatusKependudukan ? $state->label() : (string) $state)
                    ->color(fn ($state) => $state instanceof StatusKependudukan ? $state->color() : 'gray'),
            ])
            ->filters([
                SelectFilter::make('status_kependudukan')
                    ->label('Status Kependudukan')
                    ->options(collect(StatusKependudukan::cases())->mapWithKeys(fn (StatusKependudukan $s) => [$s->value => $s->label()])->all()),
                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options(collect(JenisKelamin::cases())->mapWithKeys(fn (JenisKelamin $jk) => [$jk->value => $jk->label()])->all()),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
