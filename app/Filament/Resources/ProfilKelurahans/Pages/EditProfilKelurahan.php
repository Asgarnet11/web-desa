<?php

namespace App\Filament\Resources\ProfilKelurahans\Pages;

use App\Filament\Resources\ProfilKelurahans\ProfilKelurahanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfilKelurahan extends EditRecord
{
    protected static string $resource = ProfilKelurahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
