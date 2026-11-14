<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perangkat extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'perangkat';

    protected $fillable = [
        'wilayah_id',
        'nama',
        'jabatan',
        'nip',
        'foto',
        'kontak',
        'urutan',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'status_aktif' => 'boolean',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
