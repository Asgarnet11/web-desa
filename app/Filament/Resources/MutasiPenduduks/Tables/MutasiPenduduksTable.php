<?php

namespace App\Filament\Resources\MutasiPenduduks\Tables;

use App\Enums\JenisMutasi;
use App\Enums\StatusVerifikasi;
use App\Models\MutasiPenduduk;
use App\Services\MutasiPendudukService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MutasiPenduduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('tanggal_peristiwa')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('jenis_mutasi')
                    ->label('Peristiwa')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof JenisMutasi ? $state->label() : (string) $state)
                    ->color(fn ($state) => $state instanceof JenisMutasi ? $state->color() : 'gray'),
                TextColumn::make('subjek')
                    ->label('Warga Terkait')
                    ->state(fn (MutasiPenduduk $record): string => $record->penduduk?->nama_lengkap ?? ($record->payload_data['nama_lengkap'] ?? 'Pengajuan Baru')),
                TextColumn::make('wilayah.breadcrumb_nama')
                    ->label('RT / RW'),
                TextColumn::make('nomor_surat_pengantar')
                    ->label('No. Surat')
                    ->fontFamily('mono')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('status_verifikasi')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof StatusVerifikasi ? $state->label() : (string) $state)
                    ->color(fn ($state) => $state instanceof StatusVerifikasi ? $state->color() : 'gray'),
            ])
            ->filters([
                SelectFilter::make('jenis_mutasi')
                    ->label('Jenis Peristiwa')
                    ->options(collect(JenisMutasi::cases())->mapWithKeys(fn (JenisMutasi $m) => [$m->value => $m->label()])->all()),
                SelectFilter::make('status_verifikasi')
                    ->label('Status Verifikasi')
                    ->options(collect(StatusVerifikasi::cases())->mapWithKeys(fn (StatusVerifikasi $s) => [$s->value => $s->label()])->all()),
            ])
            ->recordActions([
                Action::make('setujui')
                    ->label('Setujui & Sinkronkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Sahkan Mutasi & Sinkronkan Statistik Wilayah?')
                    ->modalDescription('Persetujuan ini otomatis memperbarui Buku Induk Penduduk, menutup status terkait (seperti kehamilan bila kelahiran), dan menyinkronkan agregat demografi kelurahan & peta GIS.')
                    ->visible(fn (MutasiPenduduk $record): bool => $record->status_verifikasi === StatusVerifikasi::Diajukan
                        && (Auth::user()?->can('verify', $record) ?? false))
                    ->action(function (MutasiPenduduk $record) {
                        $user = Auth::user();
                        if (! $user) {
                            return;
                        }

                        app(MutasiPendudukService::class)->verifikasiDanTerapkan($record, $user);

                        Notification::make()
                            ->title('Mutasi disahkan & disinkronkan real-time')
                            ->body("Nomor surat registrasi {$record->fresh()->nomor_surat_pengantar} telah diterbitkan.")
                            ->success()
                            ->send();
                    }),
                Action::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('alasan')
                            ->label('Alasan Penolakan / Kekurangan Berkas')
                            ->required(),
                    ])
                    ->visible(fn (MutasiPenduduk $record): bool => $record->status_verifikasi === StatusVerifikasi::Diajukan
                        && (Auth::user()?->can('verify', $record) ?? false))
                    ->action(function (MutasiPenduduk $record, array $data) {
                        $user = Auth::user();
                        if (! $user) {
                            return;
                        }

                        app(MutasiPendudukService::class)->tolak($record, $user, (string) $data['alasan']);

                        Notification::make()
                            ->title('Pengajuan mutasi ditolak')
                            ->warning()
                            ->send();
                    }),
                Action::make('surat_qr')
                    ->label('Surat QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('info')
                    ->url(fn (MutasiPenduduk $record): ?string => $record->nomor_surat_pengantar ? route('verifikasi.show', $record->nomor_surat_pengantar) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (MutasiPenduduk $record): bool => $record->status_verifikasi === StatusVerifikasi::Terverifikasi
                        && filled($record->nomor_surat_pengantar)),
                EditAction::make(),
            ]);
    }
}
