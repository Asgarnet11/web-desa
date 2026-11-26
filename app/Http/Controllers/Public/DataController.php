<?php

namespace App\Http\Controllers\Public;

use App\Enums\StatusPengaduan;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Umkm;
use App\Models\Wilayah;
use App\Services\StatistikService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DataController extends Controller
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    public function index(): View
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();
        $statistik = $wilayah ? $this->statistikService->getRingkasanWilayah($wilayah->id) : [];

        $totalUmkm = Umkm::where('is_publik', true)->count();
        $totalPengaduan = Pengaduan::count();
        $pengaduanSelesai = Pengaduan::where('status', StatusPengaduan::Selesai)->count();
        $rasioSelesai = $totalPengaduan > 0 ? round(($pengaduanSelesai / $totalPengaduan) * 100, 1) : 100;

        return view('pages.data.index', compact('wilayah', 'statistik', 'totalUmkm', 'totalPengaduan', 'pengaduanSelesai', 'rasioSelesai'));
    }

    public function exportCsv(): Response
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();
        $statistik = $wilayah ? $this->statistikService->getRingkasanWilayah($wilayah->id) : [];

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="satu-data-sukawarna-'.date('Ymd').'.csv"',
        ];

        $output = fopen('php://temp', 'r+');
        fputcsv($output, ['Indikator', 'Nilai', 'Satuan', 'Keterangan']);

        fputcsv($output, ['Nama Kelurahan', $wilayah?->nama ?? 'Sukawarna', '-', 'Pemerintah Kota Bandung']);
        fputcsv($output, ['Luas Wilayah', $wilayah?->luas ?? 0, 'km²', 'Kecamatan Sukasari']);
        fputcsv($output, ['Jumlah RW', $statistik['wilayah']['rw_count'] ?? 0, 'Rukun Warga', 'Wilayah Administratif']);
        fputcsv($output, ['Jumlah Penduduk', $statistik['demografi']['total_penduduk'] ?? 0, 'Jiwa', 'Data Demografi']);
        fputcsv($output, ['Jumlah Kepala Keluarga', $statistik['demografi']['total_kk'] ?? 0, 'KK', 'Data Demografi']);
        fputcsv($output, ['Penduduk Laki-laki', $statistik['demografi']['laki_laki'] ?? 0, 'Jiwa', 'Data Demografi']);
        fputcsv($output, ['Penduduk Perempuan', $statistik['demografi']['perempuan'] ?? 0, 'Jiwa', 'Data Demografi']);
        fputcsv($output, ['Total Fasilitas Publik', $statistik['fasilitas']['total'] ?? 0, 'Titik', 'Terverifikasi Sistem SIG']);
        fputcsv($output, ['Infrastruktur Berkondisi Baik', $statistik['infrastruktur']['baik'] ?? 0, 'Unit', "Persentase: {$statistik['infrastruktur']['persentase_baik']}%"]);
        fputcsv($output, ['UMKM Terdaftar', Umkm::where('is_publik', true)->count(), 'Usaha', 'Direktori Binaan']);

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        return response($csvContent, 200, $headers);
    }
}
