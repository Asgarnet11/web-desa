<?php

namespace App\Models;

use App\Enums\StatusKonten;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'pengumuman';

    protected $fillable = [
        'wilayah_id',
        'judul',
        'isi',
        'berkas',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusKonten::class,
            'published_at' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function scopeTerbit(Builder $query): Builder
    {
        return $query->where('status', StatusKonten::Terbit->value);
    }
}

