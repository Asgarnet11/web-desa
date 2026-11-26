<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use App\Services\PendudukImportService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPenduduks extends ListRecords
{
    protected static string $resource = PendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import_csv')
                ->label('Import CSV BIP')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->visible(fn (): bool => Auth::user()?->isOperator() || Auth::user()?->isSuperAdmin())
                ->form([
                    Textarea::make('csv_content')
                        ->label('Data CSV Format BIP / SIAK')
                        ->helperText('Header wajib: no_kk,nik,nama_lengkap,jenis_kelamin,tanggal_lahir,kode_rt,pekerjaan,pendidikan,hubungan_keluarga,status_kependudukan')
                        ->placeholder("no_kk,nik,nama_lengkap,jenis_kelamin,tanggal_lahir,kode_rt,pekerjaan,pendidikan,hubungan_keluarga,status_kependudukan\n7405071001900001,7405071505900002,Siti Aminah,P,1990-05-15,74.05.07.1001.RW01.RT01,Wirausaha/UMKM,SMA/SMK,istri,tetap")
                        ->rows(8)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $result = app(PendudukImportService::class)->importFromCsvString((string) $data['csv_content']);

                    Notification::make()
                        ->title("Import Selesai: {$result['imported']} warga diproses")
                        ->body($result['skipped'] > 0 ? "{$result['skipped']} baris dilewati. ".implode(' | ', array_slice($result['errors'], 0, 3)) : 'Data induk dan agregat demografi wilayah langsung diperbarui.')
                        ->status($result['skipped'] > 0 && $result['imported'] === 0 ? 'danger' : 'success')
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
