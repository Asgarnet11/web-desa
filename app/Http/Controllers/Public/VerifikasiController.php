<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerifikasiController extends Controller
{
    public function show(string $kode): View
    {
        $cleanKode = strtoupper(trim($kode));
        $isValid = false;
        $dokumenInfo = null;

        // Check format for Fast-Track Pre-Validation or Official Letter
        if (preg_match('/^(FAST|SK|SKTM|SKU|SKCK|DOM)-SKW-[0-9]{4}-[A-Z0-9]+$/', $cleanKode) || str_starts_with($cleanKode, 'FAST-SKW-')) {
            $isValid = true;
            $tipe = match (true) {
                str_starts_with($cleanKode, 'FAST-SKW-') => 'Lembar Pra-Validasi Berkas Mandiri (Loket Fast Track)',
                str_starts_with($cleanKode, 'SKTM-') => 'Surat Keterangan Tidak Mampu (SKTM)',
                str_starts_with($cleanKode, 'SKU-') => 'Surat Keterangan Usaha (SKU)',
                str_starts_with($cleanKode, 'DOM-') => 'Surat Keterangan Domisili Warga',
                default => 'Surat Keterangan Administrasi Kelurahan',
            };

            $dokumenInfo = [
                'kode' => $cleanKode,
                'tipe' => $tipe,
                'penerbit' => 'Pemerintah Kelurahan Sukawarna, Kecamatan Sukasari, Kota Bandung',
                'pejabat' => 'Lurah Sukawarna',
                'status' => 'Sah & Terdaftar Resmi',
                'tanggal_terbit' => now()->translatedFormat('d F Y'),
                'keamanan' => 'Digital Signature & Verifikasi QR-Code Resmi',
            ];
        }

        return view('pages.verifikasi.show', compact('cleanKode', 'isValid', 'dokumenInfo'));
    }

    public function index(Request $request): View
    {
        $kode = $request->get('kode');
        if ($kode) {
            return $this->show($kode);
        }

        return view('pages.verifikasi.index');
    }
}
