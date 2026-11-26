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

        // Fallback streamed dummy PDF/Document for demo / sample seeded documents
        $filename = Str::slug($dokumen->judul).'.pdf';

        return response()->streamDownload(function () use ($dokumen) {
            echo "%PDF-1.4\n";
            echo "1 0 obj << /Title ({$dokumen->judul}) /Author (Pemerintah Kelurahan Sukawarna) >> endobj\n";
            echo "2 0 obj << /Type /Catalog /Pages 3 0 R >> endobj\n";
            echo "3 0 obj << /Type /Pages /Kids [4 0 R] /Count 1 >> endobj\n";
            echo "4 0 obj << /Type /Page /Parent 3 0 R /MediaBox [0 0 612 792] /Contents 5 0 R >> endobj\n";
            echo "5 0 obj << /Length 44 >> stream\n";
            echo "BT /F1 12 Tf 50 700 TD ({$dokumen->judul}) Tj ET\n";
            echo "endstream endobj\n";
            echo "xref\n0 6\n0000000000 65535 f\n";
            echo "trailer << /Size 6 /Root 2 0 R /Info 1 0 R >>\nstartxref\n400\n%%EOF";
        }, $filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
