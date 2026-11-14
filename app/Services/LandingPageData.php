<?php

namespace App\Services;

use App\Enums\StatusVerifikasi;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\KategoriFasilitas;
use App\Models\Layanan;
use App\Models\Lembaga;
use App\Models\Pengumuman;
use App\Models\Perangkat;
use App\Models\ProfilKelurahan;
use App\Models\Umkm;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Cache;

class LandingPageData
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    public function get(?string $kodeWilayah = null): array
    {
        $wilayah = $kodeWilayah
            ? Wilayah::where('kode', $kodeWilayah)->first()
            : Wilayah::whereNotNull('batas')->first() ?? Wilayah::first();

        if (! $wilayah) {
            return [];
        }

        return Cache::remember("landing_page_data_{$wilayah->id}", 1800, function () use ($wilayah) {
            $profil = ProfilKelurahan::where('wilayah_id', $wilayah->id)->first();
            $statistik = $this->statistikService->getRingkasanWilayah($wilayah->id);

            return [
                'wilayah' => $wilayah,
                'profil' => $profil,
                'pengaturan' => $profil?->pengaturan_bagian ?? [],
                'statistik' => $statistik,
                'kategori_fasilitas' => KategoriFasilitas::all(),
                'fasilitas' => Fasilitas::where('wilayah_id', $wilayah->id)
                    ->where('status_verifikasi', StatusVerifikasi::Terverifikasi)
                    ->where('is_publik', true)
                    ->with('kategori')
                    ->take(6)
                    ->get(),
                'umkm' => Umkm::where('wilayah_id', $wilayah->id)
                    ->where('is_publik', true)
                    ->take(6)
                    ->get(),
                'perangkat' => Perangkat::where('wilayah_id', $wilayah->id)
                    ->where('status_aktif', true)
                    ->orderBy('urutan')
                    ->get(),
                'lembaga' => Lembaga::where('wilayah_id', $wilayah->id)->get(),
                'layanan' => Layanan::where('wilayah_id', $wilayah->id)
                    ->where('is_aktif', true)
                    ->get(),
                'berita' => Berita::where('wilayah_id', $wilayah->id)
                    ->terbit()
                    ->latest('published_at')
                    ->take(3)
                    ->get(),
                'pengumuman' => Pengumuman::where('wilayah_id', $wilayah->id)
                    ->terbit()
                    ->latest('published_at')
                    ->take(4)
                    ->get(),
                'agenda' => Agenda::where('wilayah_id', $wilayah->id)
                    ->where('tanggal_mulai', '>=', now()->subDays(1))
                    ->orderBy('tanggal_mulai')
                    ->take(4)
                    ->get(),
                'galeri' => Galeri::where('wilayah_id', $wilayah->id)
                    ->latest()
                    ->take(6)
                    ->get(),
            ];
        });
    }
}
