<?php

namespace App\Models;

use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Potensi extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'potensi';

    protected $fillable = [
        'wilayah_id',
        'jenis',
        'nama',
        'deskripsi',
        'nilai_volume',
        'lat',
        'lng',
        'foto',
        'periode',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
