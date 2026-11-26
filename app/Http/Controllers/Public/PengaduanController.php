<?php

namespace App\Http\Controllers\Public;

use App\Actions\BuatPengaduanAction;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(): View
    {
        return view('pages.pengaduan.index');
    }

    public function store(Request $request, BuatPengaduanAction $buatPengaduan): RedirectResponse
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'email_pelapor' => 'nullable|email|max:100',
            'telepon_pelapor' => 'required|string|max:20',
            'kategori' => 'required|string|max:50',
            'judul' => 'required|string|max:200',
            'isi' => 'required|string|max:2000',
            'lokasi' => 'nullable|string|max:200',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
        ]);

        $pengaduan = $buatPengaduan($validated);

        return redirect()->route('pengaduan.index')
            ->with('success', "Pengaduan berhasil dikirim! Catat Nomor Tiket Anda: {$pengaduan->nomor_tiket}");
    }

    public function cek(Request $request): View
    {
        $tiket = $request->get('nomor_tiket');
        $pengaduan = null;

        if ($tiket) {
            $pengaduan = Pengaduan::where('nomor_tiket', trim($tiket))->first();
        }

        return view('pages.pengaduan.cek', compact('pengaduan', 'tiket'));
    }
}
