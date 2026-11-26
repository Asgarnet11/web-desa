<?php

namespace App\Support;

class RegulasiData
{
    /**
     * Canonical list of five national & ministerial regulations governing
     * population recording, health family tracking, open data, and PDP privacy.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function daftarRegulasi(): array
    {
        return [
            [
                'kode' => 'UU No. 24 Tahun 2013',
                'tentang' => 'Perubahan atas UU No. 23 Tahun 2006 tentang Administrasi Kependudukan',
                'instansi' => 'Pemerintah Republik Indonesia / Kemendagri',
                'fokus' => 'Pengambilan & Pencatatan Peristiwa Penting (LAMPID)',
                'ringkasan' => 'Mewajibkan pencatatan setiap peristiwa kependudukan dan peristiwa penting (kelahiran, kematian, kedatangan, kepindahan, dan domisili) secara berjenjang dan akurat sebagai dasar pelayanan publik serta pemutakhiran data kependudukan.',
                'penerapan' => [
                    'Setiap laporan warga lahir, meninggal, datang baru/sementara, dan pindah keluar dicatat pada Buku Mutasi (LAMPID) tingkat RT/RW hingga Kelurahan.',
                    'Penerbitan nomor registrasi pengantar kelurahan terhubung dengan sistem verifikasi QR-Code resmi.',
                    'Pemisahan status penduduk tetap dan penduduk sementara agar hak layanan terdata adil.',
                ],
                'kata_kunci_dokumen' => 'UU No. 24 Tahun 2013',
            ],
            [
                'kode' => 'Permendagri No. 47 Tahun 2016',
                'tentang' => 'Administrasi Pemerintahan Desa (Standar Baku Buku Administrasi Penduduk)',
                'instansi' => 'Kementerian Dalam Negeri Republik Indonesia',
                'fokus' => 'Standar Struktur Buku Induk, Mutasi & Rekapitulasi Penduduk',
                'ringkasan' => 'Menjadi pedoman standar buku administrasi kependudukan operasional akar rumput yang mencakup Buku Induk Penduduk (BIP), Buku Mutasi Penduduk, Buku Rekapitulasi Jumlah Penduduk, dan Buku Penduduk Sementara sebagai acuan sinkronisasi ke Kecamatan.',
                'penerapan' => [
                    'Struktur basis data Kartu Keluarga, Data Induk Penduduk, dan Mutasi mengikuti kolom baku identitas serta hubungan keluarga.',
                    'Rekapitulasi per RT, RW, hingga Kelurahan terhitung secara berkesinambungan dari transaksi harian mutasi yang telah disahkan.',
                    'Data warga yang meninggal atau pindah keluar tetap tersimpan sebagai arsip sejarah mutasi tanpa menghapus rekam jejak surat.',
                ],
                'kata_kunci_dokumen' => 'Permendagri No. 47 Tahun 2016',
            ],
            [
                'kode' => 'Perpres No. 39 Tahun 2019',
                'tentang' => 'Satu Data Indonesia',
                'instansi' => 'Presiden Republik Indonesia / Bappenas',
                'fokus' => 'Pemrosesan Agregat, Satu Sumber Fakta & Publikasi Data Terbuka',
                'ringkasan' => 'Mengatur penyelenggaraan tata kelola data pemerintah yang akurat, mutakhir, terpadu, dapat dipertanggungjawabkan, serta mudah diakses dan dibagipakaikan melalui portal data terbuka tanpa data ganda.',
                'penerapan' => [
                    'Statistik di halaman Satu Data, Beranda, dan Peta Choropleth per-RW dihitung otomatis dari ledger kependudukan yang sama (Single Source of Truth).',
                    'Menghilangkan angka perkiraan manual atau angka acak yang saling bertentangan antar halaman.',
                    'Menerbitkan dataset agregat terbuka format CSV dan GeoJSON berstandar terbuka bagi masyarakat dan perencana pembangunan.',
                ],
                'kata_kunci_dokumen' => 'Perpres No. 39 Tahun 2019',
            ],
            [
                'kode' => 'Permendagri No. 13 Tahun 2024',
                'tentang' => 'Pos Pelayanan Terpadu (Posyandu) & Pemberdayaan Kesehatan Keluarga',
                'instansi' => 'Kementerian Dalam Negeri & Kementerian Kesehatan',
                'fokus' => 'Pengambilan & Pemantauan Ibu Hamil, Balita & Lansia Rentan',
                'ringkasan' => 'Mengukuhkan peran Posyandu lintas RW dan kader kelurahan dalam pendataan sasaran layanan kesehatan dasar—meliputi ibu hamil (termasuk risiko KEK/Resti), pemantauan tumbuh kembang balita, serta pendampingan lansia rentan.',
                'penerapan' => [
                    'Kader Kesehatan/Posyandu mencatat usia kehamilan, Hari Perkiraan Lahir (HPL), serta status risiko KEK/Resti untuk prioritas pendampingan.',
                    'Saat mutasi kelahiran bayi disahkan oleh loket kelurahan, pantauan hamil ibu otomatis selesai dan tercatat ke pemantauan balita bila didaftarkan.',
                    'Publik dan pimpinan hanya melihat jumlah agregat anonim per wilayah untuk alokasi intervensi gizi dan kesehatan.',
                ],
                'kata_kunci_dokumen' => 'Permendagri No. 13 Tahun 2024',
            ],
            [
                'kode' => 'UU No. 27 Tahun 2022',
                'tentang' => 'Pelindungan Data Pribadi (UU PDP)',
                'instansi' => 'Pemerintah Republik Indonesia / DPR RI',
                'fokus' => 'Enkripsi Penyimpanan, Pembatasan Akses & Hak Privasi Warga',
                'ringkasan' => 'Mengatur pelindungan data pribadi umum maupun spesifik/sensitif (seperti NIK, nomor KK, alamat terperinci, dan riwayat kesehatan/kehamilan) beserta kewajiban pengendali data menjamin kerahasiaan dan integritasnya.',
                'penerapan' => [
                    'Kolom NIK, No. KK, payload mutasi, dan catatan tindakan kesehatan disimpan dalam keadaan terenkripsi di database dan dicari menggunakan blind-index hash.',
                    'Tampilan tabel internal menyamarkan NIK/KK (contoh: 327301••••••0001) dan log audit sistem otomatis menyensor nilai sensitif.',
                    'Pembatasan hak akses ketat (RBAC): catatan kesehatan individu tertutup bagi publik, RT/RW, dan Kecamatan; portal publik hanya menayangkan statistik agregat tanpa nama.',
                ],
                'kata_kunci_dokumen' => 'UU No. 27 Tahun 2022',
            ],
        ];
    }

    /**
     * Structured lifecycle matrix explaining collection, storage, processing, and disclosure for citizens.
     *
     * @return array<int, array<string, string>>
     */
    public static function matriksSiklusData(): array
    {
        return [
            [
                'kategori' => 'Identitas Kependudukan & KK (NIK, No. KK, Nama, Alamat RT/RW)',
                'pengambilan' => 'Pelaporan warga di loket kelurahan atau pengajuan awal Ketua RT/RW saat peristiwa datang/lahir/pindah serta impor Buku Induk.',
                'penyimpanan' => 'Terenkripsi pada tingkat database menggunakan kunci aplikasi; hanya operator berwenang & RT/RW terlingkup yang dapat mengakses.',
                'pemrosesan' => 'Diverifikasi petugas kelurahan, kemudian diagregasi otomatis menjadi statistik jumlah jiwa, KK, gender, dan usia.',
                'publikasi' => 'TIDAK pernah dipublikasikan per individu. Publik & peta GIS hanya menampilkan jumlah total per RW/Kelurahan.',
                'acuan' => 'UU No. 24/2013, Permendagri No. 47/2016, UU No. 27/2022',
            ],
            [
                'kategori' => 'Pemantauan Kesehatan Keluarga (Ibu Hamil, Balita Gizi, Lansia)',
                'pengambilan' => 'Dicatat oleh Kader Posyandu berizin atau Operator Pelayanan saat pemeriksaan rutin Posyandu/KIA.',
                'penyimpanan' => 'Data klinis & catatan tindakan dienkripsi terpisah; diblokir bagi publik, Kecamatan, maupun Ketua RT/RW umum.',
                'pemrosesan' => 'Menghitung kebutuhan pendampingan gizi/HPL bulanan dan menutup pantauan hamil secara otomatis ketika kelahiran disahkan.',
                'publikasi' => 'Hanya angka agregat anonim (misal jumlah ibu hamil terpantau di tingkat kelurahan) sesuai Satu Data.',
                'acuan' => 'Permendagri No. 13/2024, UU No. 27/2022, Perpres No. 39/2019',
            ],
            [
                'kategori' => 'Pengaduan Geo-Civic & Pendaftaran Mandiri UMKM Warga',
                'pengambilan' => 'Diisi sukarela oleh warga melalui formulir publik untuk tindak lanjut keluhan lingkungan atau promosi usaha mikro.',
                'penyimpanan' => 'Disimpan dalam basis data kelurahan dengan nomor tiket unik dan mekanisme kurasi sebelum publikasi.',
                'pemrosesan' => 'Nomor telepon pengadu tidak ditayangkan pada peta atau beranda; UMKM hanya tayang setelah disetujui kurator kelurahan.',
                'publikasi' => 'Judul/status penanganan pengaduan untuk transparansi publik & profil usaha UMKM yang telah terkurasi.',
                'acuan' => 'UU No. 27/2022, UU No. 14/2008 (KIP), Perpres No. 39/2019',
            ],
        ];
    }
}
