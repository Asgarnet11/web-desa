<?php

namespace App\Models\Concerns;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    /**
     * Sensitive field keys automatically redacted from audit payloads (UU PDP compliance).
     *
     * @var array<int, string>
     */
    protected static array $defaultAuditMaskedKeys = [
        'nik',
        'nik_hash',
        'no_kk',
        'no_kk_hash',
        'catatan_tindakan',
        'catatan_medis',
        'payload_data',
        'password',
        'remember_token',
    ];

    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            static::recordActivity('tambah', $model, null, static::sanitizeAuditPayload($model, $model->toArray()));
        });

        static::updated(function ($model) {
            $old = array_intersect_key($model->getOriginal(), $model->getDirty());
            static::recordActivity(
                'ubah',
                $model,
                static::sanitizeAuditPayload($model, $old),
                static::sanitizeAuditPayload($model, $model->getDirty())
            );
        });

        static::deleted(function ($model) {
            static::recordActivity('hapus', $model, static::sanitizeAuditPayload($model, $model->toArray()), null);
        });
    }

    /**
     * @param  array<string, mixed>|null  $payload
     * @return array<string, mixed>|null
     */
    protected static function sanitizeAuditPayload($model, ?array $payload): ?array
    {
        if ($payload === null) {
            return null;
        }

        $maskedKeys = array_unique(array_merge(
            static::$defaultAuditMaskedKeys,
            method_exists($model, 'getAuditMaskedFields') ? $model->getAuditMaskedFields() : []
        ));

        foreach ($maskedKeys as $key) {
            if (array_key_exists($key, $payload) && $payload[$key] !== null) {
                $payload[$key] = '[TERENKRIPSI]';
            }
        }

        return $payload;
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
