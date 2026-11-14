<?php

namespace App\Models;

use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'layanan';

    protected $fillable = [
        'wilayah_id',
        'nama_layanan',
        'kategori',
        'persyaratan',
        'alur_pelayanan',
        'waktu_penyelesaian',
        'biaya',
        'jam_buka',
        'is_aktif',
    ];

    protected function casts(): array
    {
        return [
            'persyaratan' => 'array',
            'is_aktif' => 'boolean',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}

