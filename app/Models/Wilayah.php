<?php

namespace App\Models;

use App\Enums\TipeWilayah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $fillable = [
        'parent_id',
        'tipe',
        'kode',
        'nama',
        'luas',
        'lat',
        'lng',
        'batas',
    ];

    protected function casts(): array
    {
        return [
            'tipe' => TipeWilayah::class,
            'luas' => 'float',
            'lat' => 'float',
            'lng' => 'float',
            'batas' => 'array',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function demografi(): HasMany
    {
        return $this->hasMany(Demografi::class);
    }

    public function infrastruktur(): HasMany
    {
        return $this->hasMany(Infrastruktur::class);
    }

    public function potensi(): HasMany
    {
        return $this->hasMany(Potensi::class);
    }

    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class);
    }

    public function kondisiSosial(): HasMany
    {
        return $this->hasMany(KondisiSosial::class);
    }

    public function profil(): HasOne
    {
        return $this->hasOne(ProfilKelurahan::class);
    }

    public function perangkat(): HasMany
    {
        return $this->hasMany(Perangkat::class)->orderBy('urutan');
    }

    public function lembaga(): HasMany
    {
        return $this->hasMany(Lembaga::class);
    }

    public function layanan(): HasMany
    {
        return $this->hasMany(Layanan::class);
    }

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    public function kartuKeluarga(): HasMany
    {
        return $this->hasMany(KartuKeluarga::class);
    }

    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }

    public function mutasiPenduduk(): HasMany
    {
        return $this->hasMany(MutasiPenduduk::class);
    }

    public function pemantauanKesehatan(): HasMany
    {
        return $this->hasMany(PemantauanKesehatan::class);
    }

    /**
     * Traverse recursive descendant wilayah IDs cleanly (Kelurahan -> RW -> RT).
     *
     * @return array<int, int>
     */
    public function getDescendantIds(bool $includeSelf = true): array
    {
        $ids = $includeSelf ? [$this->id] : [];
        $frontier = [$this->id];
        $visited = [$this->id => true];

        while ($frontier !== []) {
            $children = self::query()
                ->whereIn('parent_id', $frontier)
                ->pluck('id')
                ->all();

            $frontier = [];
            foreach ($children as $childId) {
                if (! isset($visited[$childId])) {
                    $visited[$childId] = true;
                    $ids[] = $childId;
                    $frontier[] = $childId;
                }
            }
        }

        return $ids;
    }

    /**
     * Format human-readable hierarchical label such as "RT 01 · RW 01 · Sukawarna".
     */
    public function getBreadcrumbNamaAttribute(): string
    {
        $parts = [$this->nama];
        $current = $this->parent;
        $depth = 0;

        while ($current && $depth < 2) {
            $parts[] = $current->nama;
            $current = $current->parent;
            $depth++;
        }

        return implode(' · ', $parts);
    }

    public function isDesa(): bool
    {
        return $this->tipe === TipeWilayah::Desa;
    }

    public function isKelurahan(): bool
    {
        return $this->tipe === TipeWilayah::Kelurahan;
    }

    public function getLabelPimpinanAttribute(): string
    {
        return $this->isDesa() ? 'Kepala Desa' : 'Lurah';
    }

    public function getLabelDusunLingkunganAttribute(): string
    {
        return $this->isDesa() ? 'Dusun' : 'Lingkungan';
    }
}
