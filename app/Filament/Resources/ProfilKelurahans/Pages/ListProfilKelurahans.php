<?php

namespace App\Filament\Resources\ProfilKelurahans\Pages;

use App\Filament\Resources\ProfilKelurahans\ProfilKelurahanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfilKelurahans extends ListRecords
{
    protected static string $resource = ProfilKelurahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
