<?php

namespace App\Models;

use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use App\Support\KependudukanSecurity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KartuKeluarga extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'kartu_keluarga';

    protected $fillable = [
        'wilayah_id',
        'no_kk',
        'no_kk_hash',
        'kepala_keluarga_nama',
        'alamat_ringkas',
        'status_kk',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'no_kk' => 'encrypted',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $kk) {
            if ($kk->isDirty('no_kk') && filled($kk->no_kk)) {
                $kk->no_kk_hash = KependudukanSecurity::hashIdentifier((string) $kk->no_kk);
            }
        });
    }

    public function getNoKkTersamarAttribute(): string
    {
        return KependudukanSecurity::maskIdentifier($this->no_kk);
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(Penduduk::class, 'kartu_keluarga_id');
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(MutasiPenduduk::class, 'kartu_keluarga_id');
    }
}
