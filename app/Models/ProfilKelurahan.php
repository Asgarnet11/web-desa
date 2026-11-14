<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilKelurahan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'profil_kelurahan';

    protected $fillable = [
        'wilayah_id',
        'slogan',
        'sejarah',
        'tahun_terbentuk',
        'makna_lambang',
        'visi',
        'misi',
        'motto_pelayanan',
        'foto_kantor',
        'foto_peta_wilayah',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'kontak_telepon',
        'kontak_whatsapp',
        'kontak_email',
        'alamat_kantor',
        'jam_pelayanan',
        'social_media',
        'pengaturan_bagian',
    ];

    protected function casts(): array
    {
        return [
            'misi' => 'array',
            'social_media' => 'array',
            'pengaturan_bagian' => 'array',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}

