<?php

namespace App\Actions\Verifikasi;

use App\Enums\StatusVerifikasi;
use App\Services\StatistikService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TolakDataAction
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    public function __invoke(Model $model, string $catatanAlasan): void
    {
        $model->update([
            'status_verifikasi' => StatusVerifikasi::Ditolak,
            'catatan_verifikasi' => $catatanAlasan,
            'diverifikasi_oleh' => Auth::id(),
            'diverifikasi_pada' => now(),
        ]);

        if (isset($model->wilayah_id)) {
            $this->statistikService->clearCache($model->wilayah_id);
        }
    }
}
