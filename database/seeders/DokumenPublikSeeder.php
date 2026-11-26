<?php

namespace Database\Seeders;

use App\Models\DokumenPublik;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class DokumenPublikSeeder extends Seeder
{
    public function run(): void
    {
        $wilayah = Wilayah::where('tipe', 'kelurahan')->first() ?? Wilayah::first();
        if (! $wilayah) {
            return;
        }

        $docs = [
            [
                'judul' => 'Blangko Surat Pengantar RT/RW (Format Baku Kabupaten Konawe Selatan)',
                'kategori' => 'Formulir',
                'file_path' => 'dokumen/blangko-surat-pengantar-rt-rw.pdf',
                'ukuran_file' => '180 KB PDF',
                'download_count' => 342,
            ],
            [
                'judul' => 'Formulir Permohonan Surat Keterangan Usaha (SKU)',
                'kategori' => 'Formulir',
                'file_path' => 'dokumen/formulir-sku.docx',
                'ukuran_file' => '220 KB DOCX',
                'download_count' => 218,
            ],
            [
                'judul' => 'Formulir N1 - N4 Surat Pengantar Nikah & Dispensasi',
                'kategori' => 'Formulir',
                'file_path' => 'dokumen/formulir-nikah-n1-n4.pdf',
                'ukuran_file' => '340 KB PDF',
                'download_count' => 156,
            ],
            [
                'judul' => 'Blangko Surat Keterangan Domisili Lembaga / Yayasan',
                'kategori' => 'Formulir',
                'file_path' => 'dokumen/blangko-domisili-lembaga.docx',
                'ukuran_file' => '210 KB DOCX',
                'download_count' => 94,
            ],
            [
                'judul' => 'Formulir Surat Keterangan Tidak Mampu (SKTM) Pendidikan & Kesehatan',
                'kategori' => 'Formulir',
                'file_path' => 'dokumen/formulir-sktm.pdf',
                'ukuran_file' => '260 KB PDF',
                'download_count' => 412,
            ],
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Pelayanan Administrasi Terpadu Kelurahan Konda',
                'kategori' => 'SOP',
                'file_path' => 'dokumen/sop-pelayanan-kelurahan-konda.pdf',
                'ukuran_file' => '1.4 MB PDF',
                'download_count' => 189,
            ],
            [
                'judul' => 'Maklumat Pelayanan Publik & Standar Komitmen Waktu Kelurahan Konda',
                'kategori' => 'SOP',
                'file_path' => 'dokumen/maklumat-pelayanan.pdf',
                'ukuran_file' => '850 KB PDF',
                'download_count' => 125,
            ],
            [
                'judul' => 'Laporan Realisasi Dana Kelurahan & Pembangunan Sarana Prasarana TA 2025',
                'kategori' => 'Laporan',
                'file_path' => 'dokumen/laporan-realisasi-dana-kelurahan-2025.pdf',
                'ukuran_file' => '2.8 MB PDF',
                'download_count' => 278,
            ],
            [
                'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah Kelurahan (LAKIP) Konda',
                'kategori' => 'Laporan',
                'file_path' => 'dokumen/lakip-konda-2025.pdf',
                'ukuran_file' => '3.1 MB PDF',
                'download_count' => 143,
            ],
            [
                'judul' => 'Keputusan Lurah Konda tentang Satuan Tugas Ketahanan Pangan & Pekarangan Lestari',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/sk-lurah-satgas-ketahanan-pangan.pdf',
                'ukuran_file' => '720 KB PDF',
                'download_count' => 88,
            ],
            [
                'judul' => 'Keputusan Lurah Konda tentang Pengukuhan Forum RW & LPM Periode 2024-2027',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/sk-lurah-forum-rw-lpm.pdf',
                'ukuran_file' => '650 KB PDF',
                'download_count' => 110,
            ],
            [
                'judul' => 'Pedoman Pencatatan Mutasi Penduduk (LAMPID) Berdasarkan UU No. 24 Tahun 2013',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/pedoman-adminduk-uu-24-2013.pdf',
                'ukuran_file' => '1.2 MB PDF',
                'download_count' => 164,
            ],
            [
                'judul' => 'Petunjuk Teknis Buku Induk & Mutasi Penduduk Mengacu Permendagri No. 47 Tahun 2016',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/juknis-buku-induk-permendagri-47-2016.pdf',
                'ukuran_file' => '980 KB PDF',
                'download_count' => 142,
            ],
            [
                'judul' => 'Standar Tata Kelola Satu Data Kelurahan Mengacu Perpres No. 39 Tahun 2019',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/standar-satu-data-perpres-39-2019.pdf',
                'ukuran_file' => '1.1 MB PDF',
                'download_count' => 119,
            ],
            [
                'judul' => 'Pedoman Pemantauan Kesehatan Ibu Hamil, Balita & Lansia Mengacu Permendagri No. 13 Tahun 2024',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/pedoman-posyandu-permendagri-13-2024.pdf',
                'ukuran_file' => '890 KB PDF',
                'download_count' => 151,
            ],
            [
                'judul' => 'Kebijakan Pelindungan Data Pribadi Warga (UU No. 27 Tahun 2022 - UU PDP)',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/kebijakan-pdp-uu-27-2022.pdf',
                'ukuran_file' => '760 KB PDF',
                'download_count' => 205,
            ],
        ];

        foreach ($docs as $doc) {
            DokumenPublik::updateOrCreate(
                [
                    'wilayah_id' => $wilayah->id,
                    'judul' => $doc['judul'],
                ],
                $doc
            );
        }
    }
}
