# PRD: Sistem Informasi Pemetaan dan Database Desa/Kelurahan

Versi 1.0 | Status: Draft | Disusun: 14 November 2026

## 1. Ringkasan Eksekutif

Sistem Informasi Pemetaan dan Database Desa/Kelurahan adalah aplikasi web yang menyimpan, mengelola, dan menampilkan data wilayah dalam bentuk tabel, grafik, dan peta digital interaktif. Sistem ini menggantikan data yang tersebar di dokumen dan spreadsheet dengan satu basis data terpusat yang terstruktur, mudah dicari, dan dapat diperbarui secara berkala oleh operator di tingkat desa atau kelurahan.

Sistem dirancang fleksibel: satu aplikasi dapat melayani wilayah bertipe desa maupun kelurahan, dengan istilah, hierarki, dan kategori data yang menyesuaikan tipe wilayahnya. Sisi depan sistem berupa landing page profil kelurahan yang lengkap, sehingga aplikasi berfungsi sekaligus sebagai basis data internal dan wajah publik kelurahan.

## 2. Latar Belakang dan Masalah

Masalah yang ingin diselesaikan:

- Data desa/kelurahan tersimpan di banyak tempat (dokumen, Excel, laporan kertas) sehingga sulit dikonsolidasikan.
- Tidak ada representasi spasial: pimpinan sulit melihat sebaran fasilitas, infrastruktur, dan potensi wilayah.
- Pembaruan data tidak terjadwal dan tidak terlacak, sehingga akurasi data diragukan.
- Penyusunan laporan dan perencanaan pembangunan memakan waktu karena data harus dikumpulkan manual.

## 3. Tujuan dan Metrik Keberhasilan

### 3.1 Tujuan

1. Menyediakan satu sumber data wilayah yang terpusat dan terstruktur.
2. Memetakan lokasi fasilitas dan sebaran data tematik secara visual.
3. Mendukung perencanaan dan pengambilan keputusan berbasis data.
4. Mempermudah pembaruan data dan pembuatan laporan berkala.

### 3.2 Metrik Keberhasilan

| Metrik | Target |
| --- | --- |
| Cakupan data dasar wilayah terisi pada rilis awal | minimal 80% dari data wajib |
| Operator aktif memperbarui data minimal sekali per kuartal | minimal 90% operator |
| Waktu pembuatan laporan ringkasan wilayah | di bawah 1 menit |
| Waktu muat halaman peta (koneksi normal) | di bawah 3 detik |
| Kepuasan pengguna (survei sederhana) | minimal 4 dari 5 |

## 4. Ruang Lingkup

### 4.1 Dalam Lingkup (In Scope)

- Manajemen hierarki wilayah administratif (desa/kelurahan sampai RT).
- Manajemen data tematik: demografi, fasilitas umum, infrastruktur, potensi, dan kondisi sosial.
- Peta interaktif dengan layer, marker, dan batas wilayah.
- Dashboard statistik dan grafik.
- Import dan export data (Excel/CSV), serta laporan PDF/Excel.
- Manajemen pengguna, peran, dan hak akses.
- Log aktivitas dan riwayat perubahan data.
- Landing page profil kelurahan yang lengkap dan portal publik untuk data yang boleh dibuka.

### 4.2 Di Luar Lingkup (Out of Scope) pada Rilis Awal

- Aplikasi mobile native (rilis awal berupa web responsif).
- Integrasi langsung (API) dengan sistem kependudukan nasional.
- Pembuatan surat layanan administrasi warga.
- Pemetaan real-time berbasis sensor atau drone.

## 5. Pengguna dan Peran

| Peran | Deskripsi | Hak Akses Utama |
| --- | --- | --- |
| Super Admin | Pengelola sistem tingkat tertinggi | Seluruh fitur, termasuk konfigurasi sistem dan manajemen pengguna |
| Admin Wilayah | Pengelola tingkat kecamatan, dinas, atau instansi | Mengelola data wilayah di bawahnya, verifikasi data, laporan |
| Operator | Petugas desa/kelurahan | Input dan ubah data wilayahnya sendiri |
| Pimpinan | Kepala desa/lurah, camat, atau pejabat terkait | Melihat dashboard, peta, dan laporan (hanya baca) |
| Publik | Masyarakat umum | Melihat peta dan data publik yang telah disetujui |

## 6. Kebutuhan Fungsional

### 6.1 Modul Autentikasi dan Pengguna

- FR-01: Login dan logout dengan email/username dan kata sandi.
- FR-02: Reset kata sandi.
- FR-03: Manajemen pengguna (tambah, ubah, nonaktifkan) oleh admin.
- FR-04: Pembatasan hak akses berdasarkan peran dan wilayah (operator hanya dapat mengubah data wilayahnya).

### 6.2 Modul Wilayah

- FR-05: Mengelola hierarki: provinsi, kabupaten/kota, kecamatan, desa/kelurahan, dusun/lingkungan/RW, RT.
- FR-06: Setiap desa/kelurahan memiliki atribut tipe (desa atau kelurahan), kode wilayah, nama, luas, dan titik pusat koordinat.
- FR-07: Menyimpan dan menampilkan batas wilayah dalam format GeoJSON.
- FR-08: Label antarmuka menyesuaikan tipe wilayah (misalnya kepala desa atau lurah, dusun atau lingkungan).

### 6.3 Modul Data Tematik

- FR-09: Demografi: jumlah penduduk, kepala keluarga, komposisi usia, jenis kelamin, pendidikan, dan pekerjaan (data agregat).
- FR-10: Fasilitas umum: sekolah, fasilitas kesehatan, tempat ibadah, kantor, pasar, dan sejenisnya, lengkap dengan koordinat.
- FR-11: Infrastruktur: jalan, jembatan, irigasi, drainase, listrik, air bersih, jaringan internet, beserta kondisinya.
- FR-12: Potensi wilayah: pertanian, perikanan, UMKM, wisata, dan sumber daya lain.
- FR-13: Kondisi sosial: penerima bantuan (agregat), status perkembangan wilayah, dan kerawanan bencana.
- FR-14: Setiap data memiliki tahun/periode, sumber data, dan status verifikasi.
- FR-15: Lampiran foto dan dokumen pada data fasilitas atau infrastruktur.

### 6.4 Modul Peta Interaktif

- FR-16: Menampilkan peta dasar (OpenStreetMap) dengan zoom dan pan.
- FR-17: Menampilkan marker fasilitas dengan ikon per kategori dan popup detail.
- FR-18: Menampilkan batas wilayah sebagai polygon, dengan pewarnaan berdasarkan indikator (choropleth).
- FR-19: Layer dapat dinyalakan atau dimatikan per kategori.
- FR-20: Pencarian lokasi atau wilayah langsung dari peta.
- FR-21: Menandai lokasi baru dengan klik pada peta atau mengambil koordinat dari perangkat.
- FR-22: Mengekspor tampilan peta sebagai gambar.

### 6.5 Modul Dashboard dan Laporan

- FR-23: Dashboard ringkasan: total penduduk, jumlah fasilitas per kategori, kondisi infrastruktur, dan indikator utama.
- FR-24: Grafik perbandingan antar wilayah dan tren antar periode.
- FR-25: Laporan ringkasan wilayah dalam PDF dan Excel.
- FR-26: Filter laporan berdasarkan wilayah, kategori, dan periode.

### 6.6 Modul Import dan Export

- FR-27: Import data dari Excel/CSV menggunakan template standar.
- FR-28: Validasi saat import (format, data wajib, duplikasi) dengan laporan baris yang gagal.
- FR-29: Export data tabel ke Excel/CSV dan data spasial ke GeoJSON.

### 6.7 Modul Verifikasi dan Log

- FR-30: Alur status data: draf, diajukan, terverifikasi, ditolak.
- FR-31: Admin dapat menyetujui atau menolak data dengan catatan.
- FR-32: Log aktivitas (siapa, kapan, apa yang diubah) dan riwayat versi data penting.

### 6.8 Portal Publik

- FR-33: Halaman publik berisi peta dan statistik ringkas dari data yang berstatus terverifikasi dan ditandai publik.
- FR-34: Data pribadi tidak pernah ditampilkan di portal publik.

### 6.9 Landing Page Profil Kelurahan

Landing page adalah halaman depan publik yang menampilkan profil kelurahan secara lengkap, dengan seluruh kontennya dikelola dari panel admin tanpa perlu mengubah kode.

| Bagian | Isi | Sumber Data |
| --- | --- | --- |
| Hero | Nama kelurahan, kecamatan, kota, slogan, foto atau video latar, tombol menuju peta dan layanan, empat angka statistik utama | Pengaturan situs, data demografi |
| Profil dan sejarah | Gambaran umum, sejarah singkat, tahun terbentuk, makna lambang | Profil kelurahan |
| Visi dan misi | Visi, misi, dan motto pelayanan | Profil kelurahan |
| Struktur organisasi | Lurah, sekretaris, kepala seksi, staf, beserta foto, jabatan, dan kontak; bagan struktur; ketua RW/RT dan lembaga kemasyarakatan (LPM, PKK, Karang Taruna) | Perangkat dan lembaga |
| Wilayah geografis | Luas wilayah, batas utara, selatan, timur, dan barat, jumlah lingkungan/RW/RT, peta mini batas kelurahan | Modul wilayah |
| Statistik dan infografis | Jumlah penduduk, kepala keluarga, komposisi usia, pendidikan, dan pekerjaan dalam grafik dengan angka animasi | Modul demografi |
| Peta interaktif | Sebaran fasilitas umum dan infrastruktur dengan filter kategori | Modul peta |
| Fasilitas umum | Direktori sekolah, fasilitas kesehatan, tempat ibadah, pasar, dan lainnya, lengkap dengan alamat dan foto | Modul fasilitas |
| Potensi dan UMKM | Direktori UMKM, produk unggulan, wisata, seni dan budaya setempat | Modul potensi |
| Layanan | Daftar layanan administrasi, persyaratan, alur, jam pelayanan, dan perkiraan waktu | Layanan |
| Berita dan pengumuman | Berita kegiatan, pengumuman resmi, dan agenda mendatang | Berita, pengumuman, agenda |
| Galeri | Album foto dan video kegiatan | Galeri |
| Dokumen publik | Laporan kegiatan, peraturan, SOP, dan formulir yang dapat diunduh | Dokumen publik |
| Pengaduan dan kontak | Formulir pengaduan dan saran, nomor telepon dan WhatsApp, alamat kantor dengan peta lokasi, media sosial | Pengaduan, pengaturan situs |

Kebutuhan fungsional:

- FR-35: Seluruh bagian landing page pada tabel di atas dapat diaktifkan, dinonaktifkan, dan diurutkan dari panel admin.
- FR-36: Konten teks, foto, dan video setiap bagian dikelola lewat editor di panel admin (CMS).
- FR-37: Berita, pengumuman, dan agenda memiliki status draf dan terbit, tanggal terbit, serta kategori.
- FR-38: Direktori fasilitas dan UMKM dapat dicari dan difilter, serta tersambung ke titik di peta.
- FR-39: Formulir pengaduan menyimpan pesan ke database, memberi nomor tiket, dan dapat ditindaklanjuti oleh admin.
- FR-40: Tombol kontak cepat (telepon dan WhatsApp) dan peta lokasi kantor tersedia di seluruh halaman.
- FR-41: Statistik pada landing page diambil otomatis dari data terverifikasi, sehingga selalu sinkron dengan database.
- FR-42: Pengaturan tema dasar (warna, logo, lambang, nama kelurahan) dapat diubah dari panel admin.

Kebutuhan non-fungsional landing page:

- Desain mobile-first dan responsif, karena sebagian besar pengunjung memakai ponsel.
- Waktu muat halaman awal di bawah 3 detik; gambar dikompresi dan dimuat bertahap (lazy loading).
- SEO dasar: judul dan deskripsi halaman, tag Open Graph untuk berbagi tautan, serta sitemap.
- Kontras warna dan ukuran teks yang memadai agar mudah dibaca semua kalangan.
- Data pribadi warga tidak pernah ditampilkan; statistik hanya dalam bentuk agregat.

Data pendukung tambahan: profil\_kelurahan, perangkat, lembaga, layanan, berita, pengumuman, agenda, galeri, umkm, dokumen\_publik, pengaduan, dan pengaturan\_situs.

Kriteria penerimaan: seluruh bagian landing page tampil dengan benar di ponsel dan desktop, kontennya dapat diubah admin tanpa bantuan pengembang, dan statistik cocok dengan data di dashboard.

## 7. Kebutuhan Non-Fungsional

| Kategori | Kebutuhan |
| --- | --- |
| Kinerja | Halaman utama dan peta termuat di bawah 3 detik; query tabel besar memakai paginasi dan indeks |
| Keamanan | HTTPS, hash kata sandi, perlindungan CSRF/XSS/SQL injection, pembatasan percobaan login, kontrol akses berbasis peran dan wilayah |
| Ketersediaan | Target uptime 99% pada jam kerja; backup basis data otomatis harian |
| Skalabilitas | Mampu menampung puluhan ribu titik dan ratusan wilayah tanpa penurunan kinerja signifikan |
| Kompatibilitas | Browser modern (Chrome, Edge, Firefox, Safari); tampilan responsif untuk ponsel dan desktop |
| Kegunaan | Antarmuka berbahasa Indonesia, formulir sederhana, panduan singkat untuk operator |
| Pemeliharaan | Kode terstruktur, migrasi basis data terversi, dokumentasi instalasi dan penggunaan |
| Aksesibilitas | Kontras warna memadai dan ukuran teks yang dapat dibaca |

## 8. Model Data

### 8.1 Entitas Utama

| Entitas | Atribut Pokok |
| --- | --- |
| wilayah | id, parent\_id, tipe (provinsi, kabupaten/kota, kecamatan, desa, kelurahan, dusun, lingkungan, rw, rt), kode, nama, luas, lat, lng, batas (GeoJSON) |
| users | id, nama, email, password, peran, wilayah\_id, status aktif |
| demografi | id, wilayah\_id, periode, jumlah\_penduduk, jumlah\_kk, laki\_laki, perempuan, rincian (JSON), status verifikasi |
| kategori\_fasilitas | id, nama, ikon, warna, kelompok |
| fasilitas | id, wilayah\_id, kategori\_id, nama, alamat, lat, lng, kondisi, keterangan, foto, status verifikasi, is\_publik |
| infrastruktur | id, wilayah\_id, jenis, nama, panjang/kapasitas, kondisi, geometri (GeoJSON), periode, status verifikasi |
| potensi | id, wilayah\_id, jenis, nama, deskripsi, nilai/volume, lat, lng, periode |
| kondisi\_sosial | id, wilayah\_id, indikator, nilai, periode, status verifikasi |
| lampiran | id, relasi (polimorfik), nama berkas, jalur, tipe |
| log\_aktivitas | id, user\_id, aksi, entitas, entitas\_id, nilai\_lama, nilai\_baru, waktu |

### 8.2 Relasi Singkat

- wilayah bersifat hierarkis (parent\_id mengacu ke wilayah lain).
- Setiap data tematik terhubung ke satu wilayah.
- Setiap pengguna terikat ke satu wilayah cakupan; hak akses ke wilayah di bawahnya diturunkan dari hierarki.
- Lampiran dan log dapat terhubung ke berbagai entitas.

### 8.3 Catatan Fleksibilitas Desa dan Kelurahan

Kolom tipe pada tabel wilayah menentukan istilah label, kategori indikator yang ditampilkan, dan formulir yang aktif. Dengan pendekatan ini sistem tidak perlu dibuat ulang bila cakupan berubah dari desa ke kelurahan atau sebaliknya.

## 9. Arsitektur dan Teknologi

| Lapisan | Usulan |
| --- | --- |
| Backend | Laravel (PHP 8.2 atau lebih baru) |
| Panel admin | Filament |
| Frontend publik | Blade dengan Tailwind CSS, atau Vue.js bila dibutuhkan interaktivitas lebih |
| Basis data | MySQL (alternatif: PostgreSQL dengan PostGIS bila analisis spasial dibutuhkan) |
| Peta | Leaflet.js, tile OpenStreetMap, data batas dalam GeoJSON |
| Grafik | Chart.js atau ApexCharts |
| Laporan | DomPDF atau Snappy untuk PDF; Laravel Excel untuk Excel |
| Antrean dan tugas | Laravel Queue untuk proses import besar |
| Hosting | VPS atau cPanel dengan HTTPS dan backup terjadwal |
| Lingkungan pengembangan | Laragon (lokal), Git untuk versi kode |

Pertimbangan: untuk rilis awal, MySQL sudah memadai selama kebutuhan spasial terbatas pada penyimpanan titik dan GeoJSON. Migrasi ke PostGIS dipertimbangkan jika dibutuhkan analisis jarak, luasan, atau irisan wilayah.

## 10. Alur Pengguna Utama

### 10.1 Operator Menginput Data

1. Operator login dan membuka dashboard wilayahnya.
2. Memilih modul data (misalnya fasilitas) dan menekan tambah.
3. Mengisi formulir dan menandai lokasi pada peta atau memasukkan koordinat.
4. Menyimpan sebagai draf, lalu mengajukan untuk verifikasi.

### 10.2 Admin Memverifikasi Data

1. Admin melihat daftar data berstatus diajukan.
2. Memeriksa detail dan lokasi di peta.
3. Menyetujui atau menolak disertai catatan.
4. Data yang disetujui tampil di peta dan dashboard, dan di portal publik bila ditandai publik.

### 10.3 Pimpinan Melihat Ringkasan

1. Pimpinan login dan membuka dashboard.
2. Memfilter wilayah dan periode.
3. Melihat peta sebaran dan grafik, lalu mengunduh laporan.

### 10.4 Import Data Massal

1. Admin mengunduh template Excel.
2. Mengisi dan mengunggah berkas.
3. Sistem memvalidasi dan menampilkan hasil, termasuk baris yang gagal.
4. Data valid masuk sebagai draf untuk diverifikasi.

## 11. Daftar Halaman Antarmuka

| Area | Halaman |
| --- | --- |
| Publik | Landing page profil kelurahan (bagian 6.9), peta publik, statistik ringkas, direktori fasilitas dan UMKM, berita dan pengumuman, galeri, pengaduan, kontak |
| Autentikasi | Login, lupa kata sandi |
| Dashboard | Ringkasan, grafik, peta ringkas |
| Wilayah | Daftar, detail, formulir, unggah batas wilayah |
| Data tematik | Daftar dan formulir untuk demografi, fasilitas, infrastruktur, potensi, kondisi sosial |
| Peta | Peta penuh dengan panel layer dan pencarian |
| Verifikasi | Daftar antrean dan detail verifikasi |
| Laporan | Pembuat laporan dan riwayat unduhan |
| Import/Export | Unggah, riwayat, dan unduh template |
| Administrasi | Pengguna, peran, kategori, pengaturan sistem, log aktivitas |

Prinsip desain: tampilan bersih dan konsisten, peta sebagai elemen utama, formulir singkat dengan validasi jelas, serta kontras warna yang cukup.

## 12. Keamanan dan Privasi Data

- Data penduduk disimpan dan ditampilkan sebagai data agregat; data pribadi individu (NIK, nama warga) tidak termasuk dalam lingkup sistem.
- Portal publik hanya menampilkan data berstatus terverifikasi dan bertanda publik.
- Akses berbasis peran dan wilayah: operator tidak dapat melihat atau mengubah wilayah lain.
- Kata sandi disimpan dengan hash, sesi aman, dan perlindungan terhadap serangan umum (CSRF, XSS, SQL injection, brute force).
- Berkas unggahan dibatasi tipe dan ukuran, serta dipindai validasinya.
- Backup basis data terenkripsi dan diuji pemulihannya secara berkala.
- Seluruh perubahan penting tercatat pada log aktivitas.

## 13. Rencana Rilis

| Fase | Cakupan | Perkiraan Durasi |
| --- | --- | --- |
| Fase 0: Persiapan | Analisis kebutuhan, penetapan data wajib, pengumpulan data batas wilayah, desain basis data dan antarmuka | 2 minggu |
| Fase 1: Fondasi | Autentikasi, peran, modul wilayah, hierarki, panel admin | 2 sampai 3 minggu |
| Fase 2: Data tematik | Demografi, fasilitas, infrastruktur, potensi, kondisi sosial, lampiran | 3 minggu |
| Fase 3: Peta dan dashboard | Peta interaktif, layer, choropleth, dashboard, grafik | 3 minggu |
| Fase 4: Import, laporan, verifikasi | Import Excel, laporan PDF/Excel, alur verifikasi, log aktivitas | 2 minggu |
| Fase 5: Landing page, portal publik, dan pengujian | Landing page profil kelurahan dan portal publik, uji fungsi, keamanan, dan kinerja, perbaikan | 4 minggu |
| Fase 6: Peluncuran | Deploy, pelatihan operator, pendampingan awal | 1 sampai 2 minggu |

Total perkiraan: sekitar 17 sampai 19 minggu untuk satu pengembang, dan dapat lebih singkat bila pekerjaan dibagi.

## 14. Risiko dan Mitigasi

| Risiko | Dampak | Mitigasi |
| --- | --- | --- |
| Data batas wilayah tidak tersedia atau tidak akurat | Peta kurang tepat | Gunakan data resmi (BIG/Bappeda), mulai dari titik pusat, lengkapi polygon bertahap |
| Kualitas data operator tidak konsisten | Data tidak dapat dipercaya | Template standar, validasi form, alur verifikasi admin |
| Keterbatasan kemampuan teknis operator | Data jarang diperbarui | Antarmuka sederhana, panduan singkat, pelatihan, pendampingan |
| Kebocoran data sensitif | Risiko privasi dan hukum | Hanya data agregat, kontrol akses ketat, audit log |
| Kinerja peta menurun pada data besar | Pengalaman pengguna buruk | Clustering marker, pemuatan data per viewport, penyederhanaan geometri |
| Perubahan kebutuhan di tengah proyek | Jadwal molor | Prioritaskan fitur inti, kelola perubahan lewat backlog |
| Ketergantungan pada satu pengembang | Risiko keberlanjutan | Dokumentasi, repositori terversi, serah terima |

## 15. Asumsi dan Pertanyaan Terbuka

### 15.1 Asumsi

- Sistem dipakai oleh satu atau beberapa desa/kelurahan dalam satu wilayah kabupaten/kota.
- Data penduduk yang dikelola bersifat agregat.
- Operator memiliki akses internet dan perangkat dasar.
- Peta dasar menggunakan OpenStreetMap tanpa biaya lisensi.

### 15.2 Pertanyaan Terbuka

1. Siapa pengguna dan pemilik sistem sebenarnya (pemerintah desa/kelurahan, dinas, atau keperluan akademik)?
2. Berapa jumlah wilayah yang akan dicakup pada rilis awal?
3. Apakah data batas wilayah resmi sudah tersedia dan dapat digunakan?
4. Data tematik apa yang menjadi prioritas wajib?
5. Konten apa yang sudah tersedia untuk landing page (foto, sejarah, struktur perangkat, daftar layanan, data UMKM)?
6. Apakah diperlukan integrasi dengan sistem lain (misalnya data kependudukan dinas)?
7. Di mana sistem akan dihosting dan siapa yang bertanggung jawab atas pemeliharaannya?

## 16. Kriteria Penerimaan

Sistem dinyatakan siap rilis apabila:

1. Seluruh kebutuhan fungsional berprioritas tinggi (FR-01 sampai FR-26 dan FR-30 sampai FR-32) berjalan sesuai spesifikasi.
2. Hak akses berbasis peran dan wilayah lolos pengujian.
3. Peta menampilkan marker dan batas wilayah dengan benar serta termuat dalam batas waktu yang ditetapkan.
4. Import Excel berhasil memvalidasi dan menolak data yang tidak valid dengan pesan yang jelas.
5. Laporan PDF dan Excel dapat dihasilkan dan sesuai data.
6. Tidak ada kerentanan keamanan kritis pada pengujian dasar.
7. Backup dan pemulihan basis data telah diuji.
8. Operator telah mendapat pelatihan dan panduan penggunaan.
