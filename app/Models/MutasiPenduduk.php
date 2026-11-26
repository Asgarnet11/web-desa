<?php

namespace App\Models;

use App\Enums\JenisMutasi;
use App\Enums\StatusVerifikasi;
use App\Models\Concerns\HasVerifikasi;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutasiPenduduk extends Model
{
    use HasFactory, HasVerifikasi, HasWilayahScope, LogsActivity;

    protected $table = 'mutasi_penduduk';

    protected $fillable = [
        'wilayah_id',
        'penduduk_id',
        'kartu_keluarga_id',
        'jenis_mutasi',
        'tanggal_peristiwa',
        'asal_atau_tujuan',
        'nomor_surat_pengantar',
        'payload_data',
        'lampiran_bukti',
        'status_verifikasi',
        'catatan_verifikasi',
        'diajukan_oleh',
        'diverifikasi_oleh',
        'diverifikasi_pada',
        'disinkronkan_pada',
    ];

    protected function casts(): array
    {
        return [
            'jenis_mutasi' => JenisMutasi::class,
            'status_verifikasi' => StatusVerifikasi::class,
            'payload_data' => 'encrypted:array',
            'tanggal_peristiwa' => 'date',
            'diverifikasi_pada' => 'datetime',
            'disinkronkan_pada' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function kartuKeluarga(): BelongsTo
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id');
    }

    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diajukan_oleh');
    }
}
