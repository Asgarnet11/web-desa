<?php

namespace App\Models\Concerns;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            static::recordActivity('tambah', $model, null, $model->toArray());
        });

        static::updated(function ($model) {
            $old = array_intersect_key($model->getOriginal(), $model->getDirty());
            static::recordActivity('ubah', $model, $old, $model->getDirty());
        });

        static::deleted(function ($model) {
            static::recordActivity('hapus', $model, $model->toArray(), null);
        });
    }

    protected static function recordActivity(string $aksi, $model, ?array $nilaiLama, ?array $nilaiBaru): void
    {
        try {
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => $aksi,
                'entitas' => class_basename($model),
                'entitas_id' => $model->getKey(),
                'nilai_lama' => $nilaiLama,
                'nilai_baru' => $nilaiBaru,
                'ip_address' => Request::ip(),
                'created_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Never break runtime when logging fails
            report($e);
        }
    }
}

