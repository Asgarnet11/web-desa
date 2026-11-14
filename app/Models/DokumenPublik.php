<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenPublik extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'dokumen_publik';

    protected $fillable = [
        'wilayah_id',
        'judul',
        'kategori',
        'file_path',
        'ukuran_file',
        'download_count',
    ];

    protected function casts(): array
    {
        return [
            'download_count' => 'integer',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
