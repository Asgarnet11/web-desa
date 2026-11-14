<?php

namespace App\Models;

use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'umkm';

    protected $fillable = [
        'wilayah_id',
        'nama_usaha',
        'nama_pemilik',
        'kategori',
        'deskripsi',
        'alamat',
        'kontak_wa',
        'lat',
        'lng',
        'foto',
        'is_unggulan',
        'is_publik',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
            'is_unggulan' => 'boolean',
            'is_publik' => 'boolean',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}

