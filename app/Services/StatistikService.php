<?php

namespace App\Services;

use App\Enums\KondisiFisik;
use App\Enums\StatusVerifikasi;
use App\Models\Demografi;
use App\Models\Fasilitas;
use App\Models\Infrastruktur;
use App\Models\KondisiSosial;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Cache;

class StatistikService
{
    /**
     * Get aggregate statistics for a given wilayah (cached for 1 hour).
     */
    public function getRingkasanWilayah(int $wilayahId): array
    {
        return Cache::remember("ringkasan_wilayah_{$wilayahId}", 3600, function () use ($wilayahId) {
            $wilayah = Wilayah::find($wilayahId);
            $demografi = Demografi::where('wilayah_id', $wilayahId)->latest('periode')->first();

            $totalFasilitas = Fasilitas::where('wilayah_id', $wilayahId)
                ->where('status_verifikasi', StatusVerifikasi::Terverifikasi)
                ->count();

            $fasilitasPerKategori = Fasilitas::where('wilayah_id', $wilayahId)
                ->where('status_verifikasi', StatusVerifikasi::Terverifikasi)
                ->with('kategori')
                ->get()
                ->groupBy('kategori.nama')
                ->map->count();

            $infrastrukturBaik = Infrastruktur::where('wilayah_id', $wilayahId)
                ->where('kondisi', KondisiFisik::Baik)
                ->count();

            $totalInfrastruktur = Infrastruktur::where('wilayah_id', $wilayahId)->count();

            $indikatorSosial = KondisiSosial::where('wilayah_id', $wilayahId)
                ->latest('periode')
                ->get();

            return [
                'wilayah' => [
                    'nama' => $wilayah?->nama,
                    'tipe' => $wilayah?->tipe?->label(),
                    'luas' => $wilayah?->luas ?? 0,
                    'rw_count' => Wilayah::where('parent_id', $wilayahId)->count(),
                ],
                'demografi' => [
                    'total_penduduk' => $demografi?->jumlah_penduduk ?? 0,
                    'total_kk' => $demografi?->jumlah_kk ?? 0,
                    'laki_laki' => $demografi?->laki_laki ?? 0,
                    'perempuan' => $demografi?->perempuan ?? 0,
                    'rincian' => $demografi?->rincian ?? [],
                ],
                'fasilitas' => [
                    'total' => $totalFasilitas,
                    'per_kategori' => $fasilitasPerKategori,
                ],
                'infrastruktur' => [
                    'total' => $totalInfrastruktur,
                    'baik' => $infrastrukturBaik,
                    'persentase_baik' => $totalInfrastruktur > 0 ? round(($infrastrukturBaik / $totalInfrastruktur) * 100, 1) : 100,
                ],
                'sosial' => $indikatorSosial,
            ];
        });
    }

    /**
     * Clear statistics cache for a wilayah.
     */
    public function clearCache(int $wilayahId): void
    {
        Cache::forget("ringkasan_wilayah_{$wilayahId}");
        Cache::forget("landing_page_data_{$wilayahId}");
    }
}
