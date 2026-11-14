<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lembaga extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'lembaga';

    protected $fillable = [
        'wilayah_id',
        'nama_lembaga',
        'ketua',
        'deskripsi',
        'jumlah_anggota',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_anggota' => 'integer',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
