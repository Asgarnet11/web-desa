<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Berita::terbit()->latest('published_at');

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('ringkasan', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }

        $beritaList = $query->paginate(9)->withQueryString();
        $kategoriList = Berita::terbit()->pluck('kategori')->unique();

        $pengumumanQuery = Pengumuman::terbit()->latest('published_at');
        if ($search = $request->input('q')) {
            $pengumumanQuery->where('judul', 'like', "%{$search}%");
        }
        $pengumumanList = $pengumumanQuery->take(6)->get();

        $agendaQuery = Agenda::where('tanggal_mulai', '>=', now()->subDays(1))->orderBy('tanggal_mulai');
        if ($search = $request->input('q')) {
            $agendaQuery->where('nama_kegiatan', 'like', "%{$search}%");
        }
        $agendaList = $agendaQuery->take(6)->get();

        return view('pages.berita.index', compact('beritaList', 'kategoriList', 'pengumumanList', 'agendaList'));
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
