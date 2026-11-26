<?php

namespace App\Models;

use App\Enums\KategoriPemantauan;
use App\Enums\TingkatRisikoKesehatan;
use App\Models\Concerns\HasWilayahScope;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemantauanKesehatan extends Model
{
    use HasFactory, HasWilayahScope, LogsActivity;

    protected $table = 'pemantauan_kesehatan';

    protected $fillable = [
        'wilayah_id',
        'penduduk_id',
        'kategori',
        'status_risiko',
        'usia_kehamilan_minggu',
        'hari_perkiraan_lahir',
        'berat_badan_kg',
        'tinggi_badan_cm',
        'aktif',
        'tanggal_mulai',
        'tanggal_selesai',
        'catatan_tindakan',
        'dicatat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'kategori' => KategoriPemantauan::class,
            'status_risiko' => TingkatRisikoKesehatan::class,
            'aktif' => 'boolean',
            'usia_kehamilan_minggu' => 'integer',
            'hari_perkiraan_lahir' => 'date',
            'berat_badan_kg' => 'float',
            'tinggi_badan_cm' => 'float',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'catatan_tindakan' => 'encrypted',
        ];
    }

    public function scopeSedangAktif(Builder $query): Builder
    {
        return $query->where('aktif', true);
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }
}
