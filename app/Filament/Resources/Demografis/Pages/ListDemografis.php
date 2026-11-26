<?php

namespace App\Filament\Resources\Demografis\Pages;

use App\Enums\TipeWilayah;
use App\Filament\Resources\Demografis\DemografiResource;
use App\Models\Wilayah;
use App\Services\DemografiSyncService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListDemografis extends ListRecords
{
    protected static string $resource = DemografiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sinkronkan_ledger')
                ->label('Sinkronkan dari Ledger Penduduk')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->visible(fn (): bool => Auth::user()?->isOperator() || Auth::user()?->isSuperAdmin())
                ->action(function () {
                    $sync = app(DemografiSyncService::class);
                    $kelurahan = Wilayah::where('tipe', TipeWilayah::Kelurahan->value)->first();
                    if ($kelurahan) {
                        $sync->syncTree($kelurahan->id);
                    }

                    Notification::make()
                        ->title('Agregat demografi disinkronkan')
                        ->body('Statistik penduduk, KK, LAMPID, dan kesehatan per RT, RW, dan Kelurahan telah diperbarui.')
                        ->success()
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
