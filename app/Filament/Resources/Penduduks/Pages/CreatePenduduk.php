<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use App\Services\DemografiSyncService;
use Filament\Resources\Pages\CreateRecord;

class CreatePenduduk extends CreateRecord
{
    protected static string $resource = PendudukResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->wilayah_id) {
            app(DemografiSyncService::class)->syncWilayahAndAncestors($this->record->wilayah_id);
        }
    }
}
