<?php

namespace App\Services;

use App\Enums\StatusVerifikasi;
use App\Models\Fasilitas;
use App\Models\Wilayah;
use Illuminate\Support\Collection;

class GeoJsonService
{
    /**
     * Get GeoJSON feature for a wilayah boundary.
     */
    public function getBatasWilayahFeature(Wilayah $wilayah): ?array
    {
        if (! $wilayah->batas) {
            return null;
        }

        return [
            'type' => 'Feature',
            'id' => $wilayah->id,
            'properties' => [
                'id' => $wilayah->id,
                'nama' => $wilayah->nama,
                'tipe' => $wilayah->tipe->value,
                'kode' => $wilayah->kode,
                'luas' => $wilayah->luas,
                'lat' => $wilayah->lat,
                'lng' => $wilayah->lng,
            ],
            'geometry' => $wilayah->batas['geometry'] ?? $wilayah->batas,
        ];
    }

    /**
     * Get GeoJSON FeatureCollection for facilities.
     *
     * @param  Collection<int, Fasilitas>|null  $fasilitas
     */
    public function getFasilitasFeatureCollection(?int $wilayahId = null, ?int $kategoriId = null): array
    {
        $query = Fasilitas::with('kategori')
            ->where('status_verifikasi', StatusVerifikasi::Terverifikasi)
            ->where('is_publik', true);

        if ($wilayahId) {
            $query->where('wilayah_id', $wilayahId);
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $features = $query->get()->map(function (Fasilitas $item) {
            return [
                'type' => 'Feature',
                'id' => $item->id,
                'properties' => [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'alamat' => $item->alamat,
                    'kategori' => $item->kategori?->nama,
                    'kategori_slug' => $item->kategori?->slug,
                    'warna' => $item->kategori?->warna ?? '#2D6A4F',
                    'ikon' => $item->kategori?->ikon ?? 'heroicon-o-map-pin',
                    'kondisi' => $item->kondisi?->label(),
                    'kondisi_color' => $item->kondisi?->color(),
                    'keterangan' => $item->keterangan,
                    'foto' => $item->foto,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item->lng, $item->lat],
                ],
            ];
        })->values()->all();

        return [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
    }

    /**
     * Get Choropleth thematic data for sub-wilayahs (e.g. RWs).
     */
    public function getChoroplethData(int $wilayahId, string $indikator = 'penduduk'): array
    {
        $subWilayah = Wilayah::where('parent_id', $wilayahId)->with('demografi')->get();

        $features = $subWilayah->map(function (Wilayah $w) {
            $demografi = $w->demografi->first();
            $nilai = $demografi?->jumlah_penduduk ?? rand(1200, 3500);

            return [
                'type' => 'Feature',
                'id' => $w->id,
                'properties' => [
                    'nama' => $w->nama,
                    'kode' => $w->kode,
                    'nilai' => $nilai,
                    'label' => "{$w->nama}: {$nilai} Jiwa",
                ],
                'geometry' => $w->batas ? ($w->batas['geometry'] ?? $w->batas) : null,
            ];
        })->filter(fn ($f) => $f['geometry'] !== null)->values()->all();

        return [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
    }
}
