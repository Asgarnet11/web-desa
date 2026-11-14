<?php

namespace App\Models;

use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KondisiSosial extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'kondisi_sosial';

    protected $fillable = [
        'wilayah_id',
        'indikator',
        'nilai',
        'periode',
        'status_verifikasi',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}

