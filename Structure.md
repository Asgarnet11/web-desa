# structur.md

Panduan struktur kode proyek Sistem Informasi Pemetaan dan Database Kelurahan (Laravel, Filament, Blade, Tailwind 4, MySQL, Leaflet). Tujuannya satu: kode rapi, mudah dicari, dan tidak menumpuk di satu file.

Dokumen ini dibaca bersama `PRD` (kebutuhan) dan `design.md` (tampilan). Jika agen AI atau pengembang membuat kode baru, aturan di sini berlaku.

## 1. Prinsip

1. **Satu file, satu tanggung jawab.** Model mengurus data, controller mengurus permintaan HTTP, service mengurus logika bisnis, view mengurus tampilan.
2. **Controller tipis.** Isi controller hanya: validasi (lewat Form Request), panggil service atau action, kembalikan respons.
3. **Logika bisnis di luar controller dan view.** Perhitungan, query kompleks, import, dan pembuatan laporan ada di `Services`, `Actions`, atau `Queries`.
4. **View dipecah menjadi komponen.** Halaman besar (misalnya landing page) disusun dari komponen Blade per bagian.
5. **JavaScript dan CSS dipecah per modul.** Setiap halaman memuat hanya berkas yang dibutuhkannya.
6. **Konfigurasi dan konstanta tidak ditulis ulang.** Pakai `Enums`, `config/`, dan token tema.
7. **Nama menjelaskan isi.** Jika sulit memberi nama sebuah file, kemungkinan file itu melakukan terlalu banyak hal.

## 2. Batas Ukuran (Aturan Praktis)

| Jenis berkas | Batas yang disarankan | Jika terlewati |
|---|---|---|
| Controller | 150 baris, maksimal 7 method publik | Pecah per sumber daya atau pindahkan logika ke service |
| Method apa pun | 30 baris | Ekstrak ke method privat, action, atau service |
| Model | 200 baris | Pindahkan scope ke trait di `Models/Concerns` |
| Service atau Action | 200 baris | Pecah per use case |
| Berkas Blade | 150 baris | Ekstrak ke komponen atau partial |
| Berkas JavaScript | 200 baris | Pecah menjadi modul |
| Berkas CSS komponen | 150 baris | Pecah per komponen |
| Resource Filament | 150 baris | Pisahkan form, tabel, dan halaman ke berkas masing-masing |

Batas ini panduan, bukan hukum. Namun jika sebuah berkas melewati batas dua kali lipat, wajib dipecah.

## 3. Struktur Folder

```
project-root/
├── app/
│   ├── Actions/                  # satu aksi satu kelas (invokable)
│   │   ├── Wilayah/
│   │   ├── Verifikasi/
│   │   └── Import/
│   ├── Enums/                    # nilai tetap: tipe wilayah, status, peran
│   ├── Filament/
│   │   ├── Pages/                # halaman kustom panel admin
│   │   ├── Resources/            # satu folder per resource
│   │   │   ├── WilayahResource/
│   │   │   ├── FasilitasResource/
│   │   │   └── ...
│   │   └── Widgets/              # widget dashboard
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Public/           # landing, peta, berita, layanan, pengaduan
│   │   │   └── Api/              # GeoJSON dan data statistik untuk peta
│   │   ├── Middleware/
│   │   ├── Requests/             # Form Request per aksi
│   │   └── Resources/            # API Resource (bentuk JSON)
│   ├── Imports/                  # kelas import Excel
│   ├── Exports/                  # kelas export Excel
│   ├── Models/
│   │   └── Concerns/             # trait: HasWilayahScope, HasVerifikasi, LogsActivity
│   ├── Observers/                # pencatatan log aktivitas, pembersihan cache
│   ├── Policies/                 # hak akses per model
│   ├── Queries/                  # kelas query kompleks yang dapat dipakai ulang
│   ├── Services/                 # logika bisnis
│   ├── Support/                  # fungsi bantu kecil
│   └── View/
│       └── Components/           # kelas komponen Blade yang butuh logika
├── bootstrap/
├── config/
│   └── kelurahan.php             # pengaturan khusus aplikasi
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── docs/
│   ├── PRD.md
│   ├── design.md
│   └── structur.md
├── public/
├── resources/
│   ├── css/
│   │   ├── app.css               # hanya @import
│   │   ├── theme.css             # token dari design.md (@theme)
│   │   ├── base/                 # reset, tipografi
│   │   └── components/           # gaya per komponen
│   ├── js/
│   │   ├── app.js                # inisialisasi umum
│   │   ├── landing.js            # titik masuk landing page
│   │   ├── peta.js               # titik masuk halaman peta
│   │   └── modules/
│   │       ├── ui/               # menu, hitung angka, lightbox
│   │       └── peta/             # modul peta (bagian 6)
│   └── views/
│       ├── layouts/              # app.blade.php, admin, kosong
│       ├── components/
│       │   ├── ui/               # tombol, kartu, lencana, input
│       │   ├── landing/          # satu komponen per bagian landing
│       │   └── peta/             # panel filter, legenda
│       └── pages/
│           ├── landing/
│           ├── peta/
│           ├── berita/
│           ├── layanan/
│           └── pengaduan/
├── routes/
│   ├── web.php                   # hanya memuat berkas rute lain
│   ├── public.php                # rute halaman publik
│   └── api.php                   # rute data peta dan statistik
└── tests/
    ├── Feature/
    └── Unit/
```

## 4. Tanggung Jawab Tiap Lapisan

| Lapisan | Tugas | Tidak boleh |
|---|---|---|
| Model | Relasi, cast, scope, atribut | Logika alur bisnis, query pelaporan besar |
| Form Request | Validasi dan otorisasi input | Menyimpan data |
| Controller | Menerima request, memanggil service, mengembalikan view atau JSON | Query panjang, perhitungan, import |
| Service | Logika bisnis yang melibatkan banyak model | Mengakses request atau session langsung |
| Action | Satu tugas spesifik (misalnya setujui data) | Melakukan lebih dari satu hal |
| Query | Query kompleks yang dipakai berulang | Mengubah data |
| Policy | Aturan siapa boleh melakukan apa | Logika tampilan |
| Observer | Efek samping otomatis (log, cache) | Logika bisnis utama |
| View atau Komponen | Tampilan | Query database langsung |
| API Resource | Bentuk JSON yang dikirim ke peta | Logika bisnis |

## 5. Pembagian per Modul

Setiap modul memiliki file terpisah di tiap lapisan.

| Modul | Model | Resource admin | Controller publik | Service atau Action |
|---|---|---|---|---|
| Wilayah | `Wilayah` | `WilayahResource` | - | `WilayahService`, `ImportWilayahAction` |
| Demografi | `Demografi` | `DemografiResource` | - | `StatistikService` |
| Fasilitas | `Fasilitas`, `KategoriFasilitas` | `FasilitasResource` | `FasilitasController` | `FasilitasQuery` |
| Infrastruktur | `Infrastruktur` | `InfrastrukturResource` | - | - |
| Potensi dan UMKM | `Potensi`, `Umkm` | `UmkmResource` | `UmkmController` | - |
| Peta | - | - | `PetaController`, `Api/GeoJsonController` | `GeoJsonService` |
| Landing page | `ProfilKelurahan`, `Perangkat`, `Lembaga` | `ProfilKelurahanResource`, `PerangkatResource` | `LandingController` | `LandingPageData` |
| Berita dan pengumuman | `Berita`, `Pengumuman`, `Agenda` | tiga resource terpisah | `BeritaController` | - |
| Layanan | `Layanan` | `LayananResource` | `LayananController` | - |
| Pengaduan | `Pengaduan` | `PengaduanResource` | `PengaduanController` | `BuatPengaduanAction` |
| Verifikasi | - | halaman antrean verifikasi | - | `SetujuiDataAction`, `TolakDataAction` |
| Laporan | - | halaman laporan | - | `LaporanService`, kelas di `Exports/` |
| Pengguna | `User` | `UserResource` | - | `UserPolicy` |
| Log aktivitas | `LogAktivitas` | `LogAktivitasResource` | - | `LogAktivitasObserver` |

## 6. Panel Admin (Filament)

Satu resource dipecah ke beberapa berkas, bukan satu berkas panjang.

```
app/Filament/Resources/FasilitasResource/
├── FasilitasResource.php         # konfigurasi inti saja
├── Pages/
│   ├── ListFasilitas.php
│   ├── CreateFasilitas.php
│   └── EditFasilitas.php
├── Schemas/
│   └── FasilitasForm.php         # definisi formulir
├── Tables/
│   └── FasilitasTable.php        # kolom, filter, aksi tabel
└── RelationManagers/
```

Aturan:

- Definisi formulir dan tabel berada di kelas terpisah (`Schemas/` dan `Tables/` pada Filament 4; pada Filament 3 gunakan kelas pembantu dengan metode statis).
- Aksi bisnis (setujui, tolak, import) memanggil `Actions`, bukan berisi logika di dalam resource.
- Pembatasan data per wilayah memakai trait `HasWilayahScope` di model dan Policy, bukan `if` di setiap resource.
- Widget dashboard satu kelas per widget, mengambil data dari `StatistikService`.

## 7. Landing Page (Blade)

Halaman depan disusun dari komponen per bagian sesuai `design.md` dan PRD bagian 6.9.

```
resources/views/pages/landing/index.blade.php      # hanya merangkai komponen

resources/views/components/landing/
├── hero.blade.php
├── profil-sejarah.blade.php
├── visi-misi.blade.php
├── struktur-organisasi.blade.php
├── wilayah-statistik.blade.php
├── peta-ringkas.blade.php
├── layanan.blade.php
├── umkm.blade.php
├── berita.blade.php
├── galeri.blade.php
├── pengaduan-kontak.blade.php
└── footer.blade.php
```

Aturan:

- `index.blade.php` hanya berisi urutan `<x-landing.* />`; tidak ada markup panjang.
- Data disiapkan oleh `LandingPageData` (service) dan dikirim controller sebagai satu objek; komponen tidak melakukan query.
- Bagian yang bisa dinyalakan atau dimatikan admin dicek dari satu daftar pengaturan, bukan `@if` yang tersebar.
- Elemen yang berulang (kartu, lencana, tombol) memakai komponen di `components/ui/`.

## 8. Modul JavaScript Peta

Satu file besar `peta.js` dilarang. Pecah menjadi modul:

```
resources/js/modules/peta/
├── init-map.js                   # membuat peta dan peta dasar
├── api-client.js                 # fetch data GeoJSON dan statistik
├── config/
│   ├── marker-icons.js           # ikon dan warna per kategori
│   └── choropleth-scale.js       # skala warna peta tematik
├── layers/
│   ├── boundary-layer.js         # batas wilayah
│   ├── facility-layer.js         # marker fasilitas dan clustering
│   └── choropleth-layer.js       # peta tematik
└── ui/
    ├── filter-panel.js           # filter kategori
    ├── popup.js                  # isi popup marker
    └── legend.js                 # legenda
```

Aturan:

- Setiap modul mengekspor fungsi yang jelas; tidak ada variabel global.
- Titik masuk (`peta.js`, `landing.js`) hanya mengimpor dan merangkai modul.
- Konfigurasi Vite memakai beberapa titik masuk agar halaman lain tidak memuat Leaflet.
- Data besar dimuat per area tampilan (viewport) lewat API, bukan disematkan di halaman.

## 9. Rute

`routes/web.php` hanya memuat berkas lain:

```php
require __DIR__.'/public.php';
```

- `public.php`: halaman publik (landing, peta, berita, layanan, galeri, pengaduan).
- `api.php`: data untuk peta dan statistik (`/api/geojson/...`, `/api/statistik/...`), dengan pembatasan laju (rate limit).
- Panel admin ditangani Filament pada prefiks `/admin`; jangan menambah rute admin manual kecuali perlu.
- Rute memakai controller beranotasi nama (`->name('berita.show')`), dikelompokkan dengan `Route::controller()`.

## 10. Basis Data

- Satu migrasi untuk satu tabel atau satu perubahan; jangan menggabungkan banyak tabel.
- Urutan migrasi mengikuti ketergantungan: `wilayah` lebih dahulu, lalu tabel yang bergantung padanya.
- Nama tabel jamak berbahasa Indonesia secara konsisten (`wilayah`, `fasilitas`, `infrastruktur`, `demografi`, `berita`).
- Kolom kunci asing berformat `<tabel>_id` (misalnya `wilayah_id`); kolom koordinat `lat` dan `lng`; geometri disimpan sebagai JSON (GeoJSON).
- Seeder dipisah per data: `KategoriFasilitasSeeder`, `PeranSeeder`, `WilayahContohSeeder`, dan `DatabaseSeeder` hanya memanggilnya.
- Factory tersedia untuk setiap model yang diuji.

## 11. Konvensi Penamaan

| Hal | Aturan | Contoh |
|---|---|---|
| Kelas | PascalCase, nama jelas | `HitungStatistikWilayah` |
| Method dan variabel | camelCase | `ambilFasilitasPublik()` |
| Tabel | snake_case, jamak | `kategori_fasilitas` |
| Berkas Blade | kebab-case | `struktur-organisasi.blade.php` |
| Komponen Blade | `<x-folder.nama>` | `<x-landing.hero />` |
| Berkas JS dan CSS | kebab-case | `facility-layer.js` |
| Enum | PascalCase, nilai huruf kecil | `TipeWilayah::Kelurahan` |
| Action | kata kerja di depan | `SetujuiDataAction` |
| Service | akhiran `Service` | `GeoJsonService` |
| Form Request | `<Aksi><Model>Request` | `SimpanFasilitasRequest` |
| Commit | gaya konvensional | `feat(peta): tambah layer fasilitas` |

Bahasa kode: nama domain memakai istilah Indonesia yang sudah baku di proyek (wilayah, fasilitas, kelurahan); istilah teknis memakai bahasa Inggris (service, controller, query).

## 12. Cache dan Performa

- Data yang jarang berubah (profil, statistik ringkas, GeoJSON batas) di-cache melalui service dan dibersihkan oleh Observer saat data berubah.
- Query daftar memakai paginasi dan eager loading (`with()`); hindari N+1.
- Indeks pada kolom `wilayah_id`, `kategori_id`, `status_verifikasi`, dan kolom pencarian utama.
- Aset gambar dioptimalkan (WebP) dan dimuat bertahap.

## 13. Pengujian

- `tests/Feature`: alur utama (login dan hak akses per peran, input dan verifikasi data, import, halaman publik, API peta).
- `tests/Unit`: service, action, dan query yang berisi logika.
- Setiap Action atau Service baru disertai minimal satu pengujian.
- Pengujian hak akses wajib: operator tidak dapat mengubah data wilayah lain.

## 14. Aturan untuk Agen AI dan Pengembang

Sebelum membuat atau mengubah kode:

1. Baca `PRD`, `design.md`, dan `structur.md`.
2. Cek folder yang relevan; gunakan file yang sudah ada bila sesuai, jangan membuat duplikat.
3. Tentukan lapisan yang tepat (bagian 4) sebelum menulis kode.

Saat menulis kode:

1. Jangan menaruh logika bisnis di controller, view, atau resource Filament.
2. Jangan menambah kode ke file yang sudah mendekati batas ukuran (bagian 2); buat file baru atau pecah file tersebut.
3. Ekstrak bagian berulang menjadi komponen, trait, atau helper.
4. Gunakan token warna dan font dari `design.md`; jangan menulis nilai warna langsung.
5. Tambahkan pengujian untuk logika baru.

Sebelum selesai:

- [ ] Tidak ada file yang melewati batas ukuran tanpa alasan.
- [ ] Controller tipis dan logika ada di service atau action.
- [ ] Hak akses per peran dan wilayah sudah dicek.
- [ ] Tidak ada data pribadi warga yang tampil di halaman publik.
- [ ] Nama file dan kelas mengikuti konvensi bagian 11.
- [ ] Pengujian relevan lulus.

Perintah singkat untuk ditempel ke agen AI:

```
Baca docs/PRD.md, docs/design.md, dan docs/structur.md sebelum menulis kode.
Ikuti struktur folder dan batas ukuran file di structur.md. Controller harus tipis,
logika bisnis di Services atau Actions, tampilan dipecah menjadi komponen Blade,
dan JavaScript peta dipecah menjadi modul. Jangan menumpuk kode di satu file.
```

## 15. Contoh Alur: Menambah Data Fasilitas

1. Operator mengisi formulir di `FasilitasResource` (definisi formulir di `Schemas/FasilitasForm.php`).
2. Validasi dan otorisasi dijalankan lewat Policy dan aturan formulir.
3. Data disimpan sebagai draf di model `Fasilitas`; `LogAktivitasObserver` mencatat perubahan.
4. Operator mengajukan; `AjukanVerifikasiAction` mengubah status.
5. Admin menyetujui lewat `SetujuiDataAction`; Observer membersihkan cache terkait.
6. `Api/GeoJsonController` memanggil `GeoJsonService`, yang memakai `FasilitasQuery`, dan mengembalikan data lewat API Resource.
7. `facility-layer.js` menampilkan marker di peta; `LandingPageData` memperbarui statistik di landing page.

Setiap langkah berada di file yang berbeda, dan tidak ada satu file yang memikul seluruh alur.