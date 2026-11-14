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

class Infrastruktur extends Model
{
    use HasFactory, HasVerifikasi, HasWilayahScope, LogsActivity;

    protected $table = 'infrastruktur';

    protected $fillable = [
        'wilayah_id',
        'jenis',
        'nama',
        'volume_kapasitas',
        'kondisi',
        'geometri',
        'periode',
        'status_verifikasi',
        'catatan_verifikasi',
    ];

    protected function casts(): array
    {
        return [
            'geometri' => 'array',
            'kondisi' => KondisiFisik::class,
            'status_verifikasi' => StatusVerifikasi::class,
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
