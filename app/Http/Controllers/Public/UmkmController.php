<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Wilayah;
use Illuminate\Http\RedirectResponse;
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:150',
            'nama_pemilik' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'alamat' => 'required|string|max:200',
            'kontak_wa' => 'required|string|max:30',
            'deskripsi' => 'nullable|string|max:1000',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
        ]);

        $wilayahId = Wilayah::where('tipe', 'kelurahan')->first()?->id ?? Wilayah::first()?->id;

        Umkm::create([
            'wilayah_id' => $wilayahId,
            'nama_usaha' => $validated['nama_usaha'],
            'nama_pemilik' => $validated['nama_pemilik'],
            'kategori' => $validated['kategori'],
            'alamat' => $validated['alamat'],
            'kontak_wa' => $validated['kontak_wa'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
            'is_unggulan' => false,
            'is_publik' => false,
        ]);

        return redirect()->route('umkm.index')
            ->with('success', 'Pendaftaran UMKM berhasil dikirim! Petugas kelurahan akan memverifikasi data usaha Anda sebelum ditayangkan.');
    }
}
