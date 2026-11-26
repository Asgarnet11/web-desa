<?php

namespace App\Filament\Resources\MutasiPenduduks\Pages;

use App\Filament\Resources\MutasiPenduduks\MutasiPendudukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMutasiPenduduks extends ListRecords
{
    protected static string $resource = MutasiPendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
