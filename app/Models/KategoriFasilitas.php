<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriFasilitas extends Model
{
    use HasFactory;

    protected $table = 'kategori_fasilitas';

    protected $fillable = [
        'nama',
        'slug',
        'ikon',
        'warna',
        'kelompok',
    ];

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class, 'kategori_id');
    }
}
