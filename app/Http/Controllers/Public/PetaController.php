<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KategoriFasilitas;
use App\Models\Wilayah;
use Illuminate\View\View;

class PetaController extends Controller
{
    public function index(): View
    {
        $wilayah = Wilayah::whereNotNull('batas')->first() ?? Wilayah::first();
        $kategoriList = KategoriFasilitas::withCount(['fasilitas' => function ($q) {
            $q->where('is_publik', true);
        }])->get();

        return view('pages.peta.index', compact('wilayah', 'kategoriList'));
    }
}
