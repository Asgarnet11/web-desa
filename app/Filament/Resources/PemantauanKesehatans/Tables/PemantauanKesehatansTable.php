<?php

namespace App\Filament\Resources\PemantauanKesehatans\Tables;

use App\Enums\KategoriPemantauan;
use App\Enums\TingkatRisikoKesehatan;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PemantauanKesehatansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('penduduk.nama_lengkap')
                    ->label('Nama Warga')
                    ->weight('semibold')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof KategoriPemantauan ? $state->label() : (string) $state),
                TextColumn::make('status_risiko')
                    ->label('Status Risiko')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof TingkatRisikoKesehatan ? $state->label() : (string) $state)
                    ->color(fn ($state) => $state instanceof TingkatRisikoKesehatan ? $state->color() : 'gray'),
                TextColumn::make('usia_kehamilan_minggu')
                    ->label('Usia Hamil')
                    ->suffix(' mgg')
                    ->placeholder('—'),
                TextColumn::make('hari_perkiraan_lahir')
                    ->label('HPL')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('wilayah.breadcrumb_nama')
                    ->label('RT / RW'),
                IconColumn::make('aktif')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(collect(KategoriPemantauan::cases())->mapWithKeys(fn (KategoriPemantauan $k) => [$k->value => $k->label()])->all()),
                SelectFilter::make('status_risiko')
                    ->label('Risiko')
                    ->options(collect(TingkatRisikoKesehatan::cases())->mapWithKeys(fn (TingkatRisikoKesehatan $r) => [$r->value => $r->label()])->all()),
                Filter::make('hpl_bulan_ini')
                    ->label('HPL Bulan Ini')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('aktif', true)
                        ->where('kategori', KategoriPemantauan::IbuHamil->value)
                        ->whereBetween('hari_perkiraan_lahir', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])),
                Filter::make('sedang_aktif')
                    ->label('Hanya Status Aktif')
                    ->default()
                    ->query(fn (Builder $query): Builder => $query->where('aktif', true)),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
