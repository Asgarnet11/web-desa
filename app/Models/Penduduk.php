<?php

namespace App\Models;

use App\Enums\HubunganKeluarga;
use App\Enums\JenisKelamin;
use App\Enums\StatusKependudukan;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use App\Support\KependudukanSecurity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'penduduk';

    protected $fillable = [
        'wilayah_id',
        'kartu_keluarga_id',
        'nik',
        'nik_hash',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'hubungan_keluarga',
        'status_kependudukan',
        'status_hidup',
        'tanggal_terdaftar',
        'tanggal_nonaktif',
    ];

    protected function casts(): array
    {
        return [
            'nik' => 'encrypted',
            'jenis_kelamin' => JenisKelamin::class,
            'hubungan_keluarga' => HubunganKeluarga::class,
            'status_kependudukan' => StatusKependudukan::class,
            'tanggal_lahir' => 'date',
            'tanggal_terdaftar' => 'date',
            'tanggal_nonaktif' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $penduduk) {
            if ($penduduk->isDirty('nik') && filled($penduduk->nik)) {
                $penduduk->nik_hash = KependudukanSecurity::hashIdentifier((string) $penduduk->nik);
            }
        });
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->whereIn('status_kependudukan', [
            StatusKependudukan::Tetap->value,
            StatusKependudukan::Sementara->value,
        ]);
    }

    public function getNikTersamarAttribute(): string
    {
        return KependudukanSecurity::maskIdentifier($this->nik);
    }

    public function getUsiaAttribute(): int
    {
        return $this->tanggal_lahir?->age ?? 0;
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kartuKeluarga(): BelongsTo
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id');
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(MutasiPenduduk::class, 'penduduk_id');
    }

    public function pemantauanKesehatan(): HasMany
    {
        return $this->hasMany(PemantauanKesehatan::class, 'penduduk_id');
    }
}
