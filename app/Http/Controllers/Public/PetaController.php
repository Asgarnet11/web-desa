<?php

namespace App\Http\Controllers\Public;

use App\Enums\StatusVerifikasi;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\KategoriFasilitas;
use App\Models\Umkm;
use App\Models\Wilayah;
use Illuminate\View\View;

class PetaController extends Controller
{
    public function index(): View
    {
        $wilayah = Wilayah::whereNotNull('batas')->first() ?? Wilayah::first();

        $kategoriList = KategoriFasilitas::withCount(['fasilitas' => function ($q) {
            $q->where('is_publik', true)
                ->where('status_verifikasi', StatusVerifikasi::Terverifikasi);
        }])->get();

        $fasilitasList = Fasilitas::with('kategori')
            ->where('is_publik', true)
            ->where('status_verifikasi', StatusVerifikasi::Terverifikasi)
            ->orderBy('nama')
            ->get();

        $umkmList = Umkm::where('is_publik', true)
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->orderBy('nama_usaha')
            ->get();

        return view('pages.peta.index', compact('wilayah', 'kategoriList', 'fasilitasList', 'umkmList'));
    }
}
