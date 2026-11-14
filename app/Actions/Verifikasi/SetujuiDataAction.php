<?php

namespace App\Actions\Verifikasi;

use App\Enums\StatusVerifikasi;
use App\Services\StatistikService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SetujuiDataAction
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    public function __invoke(Model $model, ?string $catatan = null): void
    {
        $model->update([
            'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            'catatan_verifikasi' => $catatan,
            'diverifikasi_oleh' => Auth::id(),
            'diverifikasi_pada' => now(),
        ]);

        if (isset($model->wilayah_id)) {
            $this->statistikService->clearCache($model->wilayah_id);
        }
    }
}

