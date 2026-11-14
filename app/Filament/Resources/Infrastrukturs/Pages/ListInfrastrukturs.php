<?php

namespace App\Filament\Resources\Infrastrukturs\Pages;

use App\Filament\Resources\Infrastrukturs\InfrastrukturResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInfrastrukturs extends ListRecords
{
    protected static string $resource = InfrastrukturResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
