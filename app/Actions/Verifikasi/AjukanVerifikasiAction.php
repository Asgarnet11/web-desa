<?php

namespace App\Actions\Verifikasi;

use App\Enums\StatusVerifikasi;
use Illuminate\Database\Eloquent\Model;

class AjukanVerifikasiAction
{
    public function __invoke(Model $model): void
    {
        $model->update([
            'status_verifikasi' => StatusVerifikasi::Diajukan,
            'catatan_verifikasi' => null,
        ]);
    }
}

