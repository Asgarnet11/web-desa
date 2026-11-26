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
                'judul' => 'Blangko Surat Pengantar RT/RW (Format Baku Kota Bandung)',
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
                'judul' => 'Standar Operasional Prosedur (SOP) Pelayanan Administrasi Terpadu Sukawarna',
                'kategori' => 'SOP',
                'file_path' => 'dokumen/sop-pelayanan-kelurahan-sukawarna.pdf',
                'ukuran_file' => '1.4 MB PDF',
                'download_count' => 189,
            ],
            [
                'judul' => 'Maklumat Pelayanan Publik & Standar Komitmen Waktu Kelurahan Sukawarna',
                'kategori' => 'SOP',
                'file_path' => 'dokumen/maklumat-pelayanan.pdf',
                'ukuran_file' => '850 KB PDF',
                'download_count' => 125,
            ],
            [
                'judul' => 'Laporan Realisasi Program Inovasi Pemberdayaan Pembangunan Kewilayahan (PIPPK) TA 2025',
                'kategori' => 'Laporan',
                'file_path' => 'dokumen/laporan-realisasi-pippk-2025.pdf',
                'ukuran_file' => '2.8 MB PDF',
                'download_count' => 278,
            ],
            [
                'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah Kelurahan (LAKIP) Sukawarna',
                'kategori' => 'Laporan',
                'file_path' => 'dokumen/lakip-sukawarna-2025.pdf',
                'ukuran_file' => '3.1 MB PDF',
                'download_count' => 143,
            ],
            [
                'judul' => 'Keputusan Lurah Sukawarna tentang Satuan Tugas Ketahanan Pangan & Buruan Sae',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/sk-lurah-satgas-buruan-sae.pdf',
                'ukuran_file' => '720 KB PDF',
                'download_count' => 88,
            ],
            [
                'judul' => 'Keputusan Lurah Sukawarna tentang Pengukuhan Forum RW & LPM Periode 2024-2027',
                'kategori' => 'Peraturan',
                'file_path' => 'dokumen/sk-lurah-forum-rw-lpm.pdf',
                'ukuran_file' => '650 KB PDF',
                'download_count' => 110,
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
