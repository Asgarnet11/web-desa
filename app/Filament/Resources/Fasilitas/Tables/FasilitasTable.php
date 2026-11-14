<?php

namespace App\Filament\Resources\Fasilitas\Tables;

use App\Actions\Verifikasi\SetujuiDataAction;
use App\Actions\Verifikasi\TolakDataAction;
use App\Enums\StatusVerifikasi;
use App\Models\Fasilitas;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FasilitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('wilayah.nama')
                    ->label('Wilayah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge(),
                TextColumn::make('status_verifikasi')
                    ->label('Status')
                    ->badge(),
                IconColumn::make('is_publik')
                    ->label('Publik')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama'),
                SelectFilter::make('status_verifikasi')
                    ->label('Status Verifikasi')
                    ->options([
                        StatusVerifikasi::Draf->value => 'Draf',
                        StatusVerifikasi::Diajukan->value => 'Diajukan',
                        StatusVerifikasi::Terverifikasi->value => 'Terverifikasi',
                        StatusVerifikasi::Ditolak->value => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                Action::make('setujui')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Fasilitas $record): bool => ! $record->isTerverifikasi())
                    ->action(function (Fasilitas $record, SetujuiDataAction $setujui) {
                        $setujui($record);
                    }),
                Action::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Fasilitas $record): bool => ! $record->isDitolak())
                    ->form([
                        Textarea::make('catatan')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (Fasilitas $record, array $data, TolakDataAction $tolak) {
                        $tolak($record, $data['catatan']);
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
