<?php

namespace App\Models;

use App\Enums\StatusPengaduan;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'pengaduan';

    protected $fillable = [
        'wilayah_id',
        'nomor_tiket',
        'nama_pelapor',
        'email_pelapor',
        'telepon_pelapor',
        'kategori',
        'judul',
        'isi',
        'foto',
        'lokasi',
        'lat',
        'lng',
        'status',
        'tanggapan',
        'ditanggapi_oleh',
        'ditanggapi_pada',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusPengaduan::class,
            'lat' => 'float',
            'lng' => 'float',
            'ditanggapi_pada' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function penanggap(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ditanggapi_oleh');
    }
}
