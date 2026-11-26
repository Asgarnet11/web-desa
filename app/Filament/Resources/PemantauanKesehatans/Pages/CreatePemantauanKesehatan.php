<?php

namespace App\Filament\Resources\PemantauanKesehatans\Pages;

use App\Filament\Resources\PemantauanKesehatans\PemantauanKesehatanResource;
use App\Services\DemografiSyncService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePemantauanKesehatan extends CreateRecord
{
    protected static string $resource = PemantauanKesehatanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['dicatat_oleh'] = Auth::id();

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->record->wilayah_id) {
            app(DemografiSyncService::class)->syncWilayahAndAncestors($this->record->wilayah_id);
        }
    }
}
