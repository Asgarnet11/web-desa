<?php

namespace App\Filament\Resources\PemantauanKesehatans\Pages;

use App\Filament\Resources\PemantauanKesehatans\PemantauanKesehatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPemantauanKesehatans extends ListRecords
{
    protected static string $resource = PemantauanKesehatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
