<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\Wilayah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DokumenPublikController extends Controller
{
    public function index(Request $request): View
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();

        $query = DokumenPublik::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'semua') {
            $query->where('kategori', $request->input('kategori'));
        }

        $dokumenList = $query->latest()->paginate(12)->withQueryString();

        $totalDokumen = DokumenPublik::count();
        $totalDownload = DokumenPublik::sum('download_count');
        $kategoriList = DokumenPublik::select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('pages.dokumen.index', compact(
            'wilayah',
            'dokumenList',
            'totalDokumen',
            'totalDownload',
            'kategoriList'
        ));
    }

    public function download(DokumenPublik $dokumen): BinaryFileResponse|StreamedResponse|RedirectResponse
    {
        $dokumen->increment('download_count');

        // Check if file_path is external URL
        if (str_starts_with($dokumen->file_path, 'http://') || str_starts_with($dokumen->file_path, 'https://')) {
            return redirect()->away($dokumen->file_path);
        }

        // Check if file exists in public storage
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            return Storage::disk('public')->download($dokumen->file_path, basename($dokumen->file_path));
        }

        // Fallback streamed valid single-page PDF if an ad-hoc DB record lacks an uploaded file
        $filename = Str::slug($dokumen->judul).'.pdf';

        return response()->streamDownload(function () use ($dokumen) {
            $safeTitle = str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], Str::ascii($dokumen->judul));
            $streamText = "BT /F1 14 Tf 54 740 Td (PEMERINTAH KELURAHAN KONDA - KONAWE SELATAN) Tj 0 -26 Td /F1 11 Tf ({$safeTitle}) Tj 0 -22 Td /F1 10 Tf (Dokumen arsip resmi Kelurahan Konda - silakan hubungi loket bila lampiran belum tersedia.) Tj ET";

            $objects = [
                1 => '<< /Type /Catalog /Pages 2 0 R >>',
                2 => '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
                3 => '<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 595 842] /Contents 5 0 R >>',
                4 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
                5 => '<< /Length '.strlen($streamText)." >>\nstream\n{$streamText}\nendstream",
            ];

            $pdf = "%PDF-1.4\n";
            $offsets = [0];
            foreach ($objects as $num => $body) {
                $offsets[$num] = strlen($pdf);
                $pdf .= "{$num} 0 obj\n{$body}\nendobj\n";
            }

            $xrefPos = strlen($pdf);
            $pdf .= "xref\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
            foreach ($objects as $num => $_) {
                $pdf .= sprintf("%010d 00000 n \n", $offsets[$num]);
            }
            $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xrefPos}\n%%EOF";

            echo $pdf;
        }, $filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
