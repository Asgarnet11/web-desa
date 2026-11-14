<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Wilayah;
use Illuminate\View\View;

class LayananController extends Controller
{
    public function index(): View
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();
        $layananGrouped = Layanan::where('is_aktif', true)
            ->get()
            ->groupBy('kategori');

        return view('pages.layanan.index', compact('wilayah', 'layananGrouped'));
    }
}

