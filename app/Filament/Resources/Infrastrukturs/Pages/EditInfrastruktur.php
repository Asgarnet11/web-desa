<?php

namespace App\Filament\Resources\Infrastrukturs\Pages;

use App\Filament\Resources\Infrastrukturs\InfrastrukturResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInfrastruktur extends EditRecord
{
    protected static string $resource = InfrastrukturResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
