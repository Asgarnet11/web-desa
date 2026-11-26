<?php

namespace App\Filament\Resources\PemantauanKesehatans\Pages;

use App\Filament\Resources\PemantauanKesehatans\PemantauanKesehatanResource;
use App\Services\DemografiSyncService;
use Filament\Resources\Pages\EditRecord;

class EditPemantauanKesehatan extends EditRecord
{
    protected static string $resource = PemantauanKesehatanResource::class;

    protected function afterSave(): void
    {
        if ($this->record->wilayah_id) {
            app(DemografiSyncService::class)->syncWilayahAndAncestors($this->record->wilayah_id);
        }
    }
}
