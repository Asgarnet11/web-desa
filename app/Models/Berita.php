<?php

namespace App\Models;

use App\Enums\StatusKonten;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'berita';

    protected $fillable = [
        'wilayah_id',
        'user_id',
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'foto',
        'status',
        'published_at',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusKonten::class,
            'published_at' => 'datetime',
            'views_count' => 'integer',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeTerbit(Builder $query): Builder
    {
        return $query->where('status', StatusKonten::Terbit->value)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}

