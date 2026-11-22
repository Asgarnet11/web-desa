<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index(Request $request): View
    {
        $query = Umkm::where('is_publik', true);

        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $umkmList = $query->paginate(12)->withQueryString();
        $kategoriList = Umkm::where('is_publik', true)->pluck('kategori')->unique();

        return view('pages.umkm.index', compact('umkmList', 'kategoriList'));
    }
}
