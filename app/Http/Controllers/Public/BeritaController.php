<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Berita::terbit()->latest('published_at');

        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }

        $beritaList = $query->paginate(9)->withQueryString();
        $kategoriList = Berita::terbit()->pluck('kategori')->unique();

        return view('pages.berita.index', compact('beritaList', 'kategoriList'));
    }

    public function show(string $slug): View
    {
        $berita = Berita::terbit()->where('slug', $slug)->firstOrFail();
        $berita->increment('views_count');

        $beritaTerkait = Berita::terbit()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.berita.show', compact('berita', 'beritaTerkait'));
    }
}

