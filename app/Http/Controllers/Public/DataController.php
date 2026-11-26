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
            'Content-Disposition' => 'attachment; filename="satu-data-konda-'.date('Ymd').'.csv"',
        ];

        $output = fopen('php://temp', 'r+');
        fputcsv($output, ['Indikator', 'Nilai', 'Satuan', 'Keterangan']);

        $rincian = $statistik['demografi']['rincian'] ?? [];
        $kesehatan = $rincian['kesehatan_keluarga'] ?? [];
        $mutasi = $rincian['mutasi_tahun_ini'] ?? [];

        fputcsv($output, ['Nama Kelurahan', $wilayah?->nama ?? 'Konda', '-', 'Pemerintah Kabupaten Konawe Selatan']);
        fputcsv($output, ['Luas Wilayah', $wilayah?->luas ?? 0, 'km²', 'Kecamatan Konda']);
        fputcsv($output, ['Jumlah RW', $statistik['wilayah']['rw_count'] ?? 0, 'Rukun Warga', 'Wilayah Administratif']);
        fputcsv($output, ['Jumlah Penduduk', $statistik['demografi']['total_penduduk'] ?? 0, 'Jiwa', 'Agregat Real-Time Buku Induk']);
        fputcsv($output, ['Jumlah Kepala Keluarga', $statistik['demografi']['total_kk'] ?? 0, 'KK', 'Agregat Real-Time Buku Induk']);
        fputcsv($output, ['Penduduk Laki-laki', $statistik['demografi']['laki_laki'] ?? 0, 'Jiwa', 'Agregat Real-Time Buku Induk']);
        fputcsv($output, ['Penduduk Perempuan', $statistik['demografi']['perempuan'] ?? 0, 'Jiwa', 'Agregat Real-Time Buku Induk']);
        fputcsv($output, ['Mutasi Kelahiran (Tahun Berjalan)', $mutasi['kelahiran'] ?? 0, 'Peristiwa', 'Buku Mutasi LAMPID']);
        fputcsv($output, ['Mutasi Kedatangan (Tahun Berjalan)', $mutasi['datang'] ?? 0, 'Peristiwa', 'Buku Mutasi LAMPID']);
        fputcsv($output, ['Mutasi Kepindahan (Tahun Berjalan)', $mutasi['pindah_keluar'] ?? 0, 'Peristiwa', 'Buku Mutasi LAMPID']);
        fputcsv($output, ['Mutasi Kematian (Tahun Berjalan)', $mutasi['kematian'] ?? 0, 'Peristiwa', 'Buku Mutasi LAMPID']);
        fputcsv($output, ['Ibu Hamil Terpantau (Agregat Anonim)', $kesehatan['ibu_hamil'] ?? 0, 'Jiwa', 'Pemantauan Posyandu UU PDP']);
        fputcsv($output, ['Balita Terpantau Gizi (Agregat Anonim)', $kesehatan['balita_gizi'] ?? 0, 'Balita', 'Pemantauan Posyandu UU PDP']);
        fputcsv($output, ['Lansia Rentan Terdata (Agregat Anonim)', $kesehatan['lansia_rentan'] ?? 0, 'Jiwa', 'Pemantauan Posyandu UU PDP']);
        fputcsv($output, ['Total Fasilitas Publik', $statistik['fasilitas']['total'] ?? 0, 'Titik', 'Terverifikasi Sistem SIG']);
        fputcsv($output, ['Infrastruktur Berkondisi Baik', $statistik['infrastruktur']['baik'] ?? 0, 'Unit', "Persentase: {$statistik['infrastruktur']['persentase_baik']}%"]);
        fputcsv($output, ['UMKM Terdaftar', Umkm::where('is_publik', true)->count(), 'Usaha', 'Direktori Binaan']);

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        return response($csvContent, 200, $headers);
    }
}
