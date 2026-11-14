<?php

namespace App\Models;

use App\Enums\StatusVerifikasi;
use App\Models\Concerns\HasVerifikasi;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demografi extends Model
{
    use HasFactory, HasVerifikasi, HasWilayahScope, LogsActivity;

    protected $table = 'demografi';

    protected $fillable = [
        'wilayah_id',
        'periode',
        'jumlah_penduduk',
        'jumlah_kk',
        'laki_laki',
        'perempuan',
        'rincian',
        'status_verifikasi',
        'catatan_verifikasi',
        'diverifikasi_oleh',
        'diverifikasi_pada',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_penduduk' => 'integer',
            'jumlah_kk' => 'integer',
            'laki_laki' => 'integer',
            'perempuan' => 'integer',
            'rincian' => 'array',
            'status_verifikasi' => StatusVerifikasi::class,
            'diverifikasi_pada' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
