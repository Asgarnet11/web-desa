<?php

namespace App\Filament\Resources\Pengaduans\Tables;

use App\Enums\StatusPengaduan;
use App\Models\Pengaduan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PengaduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->fontFamily('mono')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_pelapor')
                    ->label('Pelapor')
                    ->searchable(),
                TextColumn::make('telepon_pelapor')
                    ->label('WhatsApp/HP')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->badge(),
                TextColumn::make('judul')
                    ->label('Perihal')
                    ->limit(35)
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Tanggal Lapor')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        StatusPengaduan::Menunggu->value => 'Menunggu',
                        StatusPengaduan::Diproses->value => 'Diproses',
                        StatusPengaduan::Selesai->value => 'Selesai',
                        StatusPengaduan::Ditolak->value => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                Action::make('tanggapi')
                    ->label('Tindak Lanjut')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->color('primary')
                    ->form([
                        Select::make('status')
                            ->label('Status Baru')
                            ->options([
                                StatusPengaduan::Diproses->value => 'Sedang Diproses',
                                StatusPengaduan::Selesai->value => 'Selesai Ditindaklanjuti',
                                StatusPengaduan::Ditolak->value => 'Ditolak / Tidak Valid',
                            ])
                            ->required(),
                        Textarea::make('tanggapan')
                            ->label('Uraian Tindak Lanjut / Jawaban')
                            ->required()
                            ->rows(4),
                    ])
                    ->action(function (Pengaduan $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'tanggapan' => $data['tanggapan'],
                            'ditanggapi_oleh' => Auth::id(),
                            'ditanggapi_pada' => now(),
                        ]);
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
