<?php

namespace App\Filament\Resources\MutasiPenduduks\Pages;

use App\Enums\StatusVerifikasi;
use App\Filament\Resources\MutasiPenduduks\MutasiPendudukResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateMutasiPenduduk extends CreateRecord
{
    protected static string $resource = MutasiPendudukResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['diajukan_oleh'] = Auth::id();
        $data['status_verifikasi'] = StatusVerifikasi::Diajukan->value;

        return $data;
    }
}
