<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\Wilayah;
use App\Support\RegulasiData;
use Illuminate\View\View;

class RegulasiController extends Controller
{
    public function index(): View
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();
        $regulasiList = RegulasiData::daftarRegulasi();
        $matriksData = RegulasiData::matriksSiklusData();

        $dokumenRegulasi = DokumenPublik::query()
            ->where('kategori', 'Peraturan')
            ->latest()
            ->get();

        return view('pages.regulasi.index', compact(
            'wilayah',
            'regulasiList',
            'matriksData',
            'dokumenRegulasi'
        ));
    }
}
