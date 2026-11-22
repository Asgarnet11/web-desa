<?php

namespace App\Models\Concerns;

use App\Enums\StatusVerifikasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasVerifikasi
{
    public function diverifikasiOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function scopeTerverifikasi(Builder $query): Builder
    {
        return $query->where($this->getTable().'.status_verifikasi', StatusVerifikasi::Terverifikasi->value);
    }

    public function scopeDiajukan(Builder $query): Builder
    {
        return $query->where($this->getTable().'.status_verifikasi', StatusVerifikasi::Diajukan->value);
    }

    public function scopeDraf(Builder $query): Builder
    {
        return $query->where($this->getTable().'.status_verifikasi', StatusVerifikasi::Draf->value);
    }

    public function isTerverifikasi(): bool
    {
        return $this->status_verifikasi === StatusVerifikasi::Terverifikasi->value
            || $this->status_verifikasi === StatusVerifikasi::Terverifikasi;
    }

    public function isDiajukan(): bool
    {
        return $this->status_verifikasi === StatusVerifikasi::Diajukan->value
            || $this->status_verifikasi === StatusVerifikasi::Diajukan;
    }

    public function isDraf(): bool
    {
        return $this->status_verifikasi === StatusVerifikasi::Draf->value
            || $this->status_verifikasi === StatusVerifikasi::Draf;
    }

    public function isDitolak(): bool
    {
        return $this->status_verifikasi === StatusVerifikasi::Ditolak->value
            || $this->status_verifikasi === StatusVerifikasi::Ditolak;
    }
}
