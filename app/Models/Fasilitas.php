<?php

namespace App\Models;

use App\Enums\KondisiFisik;
use App\Enums\StatusVerifikasi;
use App\Models\Concerns\HasVerifikasi;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fasilitas extends Model
{
    use HasFactory, HasVerifikasi, HasWilayahScope, LogsActivity;

    protected $table = 'fasilitas';

    protected $fillable = [
        'wilayah_id',
        'kategori_id',
        'nama',
        'alamat',
        'lat',
        'lng',
        'kondisi',
        'keterangan',
        'foto',
        'status_verifikasi',
        'catatan_verifikasi',
        'diverifikasi_oleh',
        'diverifikasi_pada',
        'is_publik',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
            'kondisi' => KondisiFisik::class,
            'status_verifikasi' => StatusVerifikasi::class,
            'is_publik' => 'boolean',
            'diverifikasi_pada' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriFasilitas::class, 'kategori_id');
    }
}

