---
version: "alpha"
name: "Kelurahan Solarpunk"
description: "Desain untuk landing page profil kelurahan, peta interaktif, dan panel admin. Hangat, hijau, optimis, dan mudah dibaca semua kalangan. Turunan dari referensi Solarpunk Utopico."
colors:
  primary: "#2D6A4F"
  primary-dark: "#1B4332"
  secondary: "#FFB703"
  tertiary: "#219EBC"
  tertiary-dark: "#17708A"
  neutral: "#FFF8E7"
  surface: "#FFFFFF"
  accent: "#52B788"
  ink: "#1F2D26"
  sky: "#8ECFEA"
  danger: "#B3361A"
typography:
  display:
    fontFamily: Comfortaa
    fontSize: 2.5rem
    fontWeight: 700
  h1:
    fontFamily: Comfortaa
    fontSize: 2.25rem
    fontWeight: 700
  body-md:
    fontFamily: Nunito
    fontSize: 1rem
    fontWeight: 400
rounded:
  sm: 16px
  md: 24px
  lg: 40px
  pill: 9999px
components:
  button-primary:
    backgroundColor: "{colors.secondary}"
    textColor: "{colors.primary-dark}"
    rounded: "{rounded.lg}"
    padding: 14px 28px
  button-dark:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.neutral}"
    rounded: "{rounded.pill}"
    padding: 10px 20px
  card:
    backgroundColor: "{colors.surface}"
    rounded: "{rounded.md}"
    padding: 24px
---

## Overview

Antarmuka untuk sistem informasi pemetaan dan database kelurahan. Sisi depan berupa landing page profil kelurahan yang lengkap, sisi belakang berupa panel admin (Filament) untuk operator, dan keduanya berbagi satu bahasa visual yang sama.

Arah gaya adalah solarpunk komunitas: warna hijau botani, kuning matahari, dan biru langit; sudut membulat dan bentuk organik; ilustrasi tanaman dan burung sebagai hiasan kecil. Kesannya optimis, bersih, dan dekat dengan warga, bukan kaku seperti situs instansi pada umumnya.

Referensi visual: template Solarpunk Utopico dan tangkapan layar landing page Helios Co-op. Dari tangkapan layar itu diambil: latar langit biru dengan cahaya lembut, navigasi berbentuk kapsul melayang di tengah, lencana kecil di atas judul, judul besar dengan satu kata disorot, dua tombol (utama dan sekunder), foto dalam bingkai membulat, serta ilustrasi daun dan burung yang menimpa sudut bingkai.

- Density: 5/10, seimbang
- Variance: 7/10, ekspresif tetapi tetap rapi
- Motion: 6/10, halus dan tidak mengganggu
- Terang/gelap: mode terang saja pada rilis awal

Kata kunci: komunitas, hijau, hangat, terbuka, ramah warga, optimis, lokal.

## Colors

- **Hijau Daun** (#2D6A4F): warna utama. Navigasi aktif, tombol gelap, judul, tautan penting.
- **Hijau Tua** (#1B4332): teks di atas latar langit atau latar berwarna, teks pada tombol kuning.
- **Kuning Surya** (#FFB703): warna aksi utama (tombol utama), sorotan kata, penanda penting. Dipakai sebagai isian, bukan sebagai warna teks.
- **Biru Langit** (#219EBC): lencana, ikon informasi, elemen dekoratif.
- **Biru Tautan** (#17708A): tautan dan teks berwarna biru di atas latar terang (kontras di atas 4,5:1).
- **Putih Hangat** (#FFF8E7): latar halaman dan latar bagian selang-seling.
- **Putih** (#FFFFFF): permukaan kartu, bingkai, dan formulir.
- **Hijau Lumut** (#52B788): aksen sekunder, garis bingkai, indikator aktif, titik peta.
- **Langit** (#8ECFEA): latar hero, dengan gradien ke #CDEBF5 dan cahaya radial lembut di belakang foto.
- **Tanah Liat** (#B3361A): hanya untuk status bahaya dan galat.
- **Tinta** (#1F2D26): teks isi di atas latar terang. Jangan memakai hitam murni (#000000).

Aturan kontras:

- Teks isi di atas putih atau putih hangat memakai Tinta atau Hijau Daun.
- Teks di atas latar langit memakai Hijau Tua, bukan hijau pudar.
- Kuning Surya tidak dipakai sebagai warna teks pada latar terang (kontrasnya rendah). Kata yang disorot memakai latar kuning dengan teks Hijau Tua.
- Batas saturasi aksen 80%; hindari warna neon.

## Typography

- **Display dan judul:** Comfortaa, bobot 700, huruf bulat geometris yang ramah.
- **Isi teks:** Nunito, bobot 400, 16px dengan tinggi baris 1,6, maksimal 72 karakter per baris.
- **Label UI dan keterangan:** Nunito, 0,875rem, bobot 600, sedikit jarak huruf.
- **Angka statistik:** Comfortaa, bobot 700, ukuran besar, tabular-nums.

Skala:

- Hero: clamp(2.5rem, 5vw, 4rem)
- H1: 2.25rem
- H2: 1.75rem
- H3: 1.25rem
- Isi: 1rem / 1.6
- Kecil: 0.875rem

Font dimuat dari server sendiri (self-host, misalnya lewat paket fontsource) dengan font-display: swap dan cadangan sistem (system-ui, sans-serif) agar cepat di koneksi lambat.

## Layout

- **Grid:** CSS Grid. Lebar maksimal 1280px, rata tengah, padding samping 1,5rem.
- **Satuan spasi:** 0,5rem (8px).
- **Jarak antarbagian:** clamp(4rem, 8vw, 7rem).
- **Hero:** komposisi asimetris. Teks di kiri, foto berbingkai di kanan; di ponsel, teks di atas dan foto di bawah.
- **Bagian fitur:** grid asimetris dengan kartu berukuran beragam. Jangan memakai tiga kolom sama lebar.
- **Latar selang-seling:** putih hangat, putih, dan hijau sangat muda agar bagian terasa terpisah tanpa garis tebal.
- **Mobile:** semua multi-kolom menjadi satu kolom di bawah 768px; tidak boleh ada gulir horizontal. Rancang untuk ponsel lebih dahulu.
- **z-index:** dasar (0), navigasi menempel (100), overlay (200), modal (300), toast (500).
- Tinggi layar penuh memakai min-h-[100dvh], bukan h-screen.

## Elevation & Depth

- Bayangan lembut: 0 2px 12px rgba(31, 45, 38, 0.08); bayangan angkat saat hover: 0 8px 24px rgba(31, 45, 38, 0.12).
- Cahaya radial kuning-hijau yang sangat lembut di belakang foto hero.
- Navigasi kapsul: latar putih transparan 70%, blur latar 12px, tanpa garis tegas.
- Boleh memakai pola daun atau garis tanaman tipis sebagai hiasan latar dengan opasitas rendah.

## Shapes

- Sudut membulat besar di semua elemen; tidak ada sudut tajam.
- Tombol utama memakai radius organik (tidak simetris) seperti pada referensi, misalnya 36px 28px 40px 24px.
- Tombol navigasi dan lencana berbentuk kapsul penuh.
- Bingkai foto: padding 12px berwarna putih kehijauan, garis 2px Hijau Lumut, radius 28px; foto di dalamnya radius 20px.
- Sorotan kata pada judul: kotak putih atau kuning dengan rotasi sekitar -2 derajat dan radius 12px.

## Components

- **Navigasi:** kapsul melayang di tengah berisi 4 sampai 5 tautan (Profil, Layanan, Peta, Berita, Kontak). Logo atau lambang kelurahan di kiri, tombol gelap "Hubungi Kami" atau "Layanan" di kanan. Tautan aktif bobot 700 dengan latar hijau muda. Di ponsel berubah menjadi menu hamburger dengan panel penuh.
- **Tombol utama:** isian Kuning Surya, teks Hijau Tua bobot 700, radius organik. Hover: naik 2px dan bayangan lembut. Aktif: turun 1px.
- **Tombol gelap:** isian Hijau Daun, teks Putih Hangat, bentuk kapsul. Dipakai untuk aksi di navigasi.
- **Tombol sekunder:** garis 2px Hijau Daun, latar putih transparan, teks Hijau Daun. Hover: isian hijau sangat muda.
- **Lencana (badge):** kapsul kecil, latar Biru Langit transparan 20%, teks Biru Tautan, bobot 700. Dipakai di atas judul bagian, contoh: "Profil Kelurahan".
- **Kartu:** isian putih, radius 24px, bayangan lembut, garis 1px hijau sangat muda. Hover: sedikit naik.
- **Kartu statistik:** angka besar Comfortaa, label kecil di bawahnya, ikon di pojok dalam lingkaran hijau muda. Angka dihitung naik saat masuk layar.
- **Kartu perangkat kelurahan:** foto bulat atau persegi membulat, nama, jabatan, tombol kontak.
- **Kartu berita:** gambar rasio 16:9 dengan radius atas 24px, tanggal sebagai lencana, judul maksimal dua baris.
- **Formulir:** label di atas kolom, garis 1px, radius 16px, cincin fokus 2px Hijau Lumut dengan offset 2px, pesan galat di bawah kolom dengan warna Tanah Liat. Tidak memakai label mengambang.
- **Tabel (admin):** baris selang-seling putih dan hijau sangat muda, header Hijau Tua bobot 700, tindakan baris berupa ikon dengan teks bantuan.
- **Skeleton:** animasi shimmer sesuai ukuran komponen. Tidak memakai spinner bulat.
- **Keadaan kosong:** ilustrasi tanaman kecil, teks penjelas, dan tombol aksi.

## Page Sections (Landing Page Profil Kelurahan)

Urutan dan gaya setiap bagian. Isi lengkap mengacu pada PRD bagian 6.9.

1. **Hero:** latar langit dengan gradien dan cahaya radial; lencana, judul (satu kata disorot), deskripsi singkat, tombol utama "Lihat Layanan" dan tombol sekunder "Lihat Peta"; foto kantor atau wilayah kelurahan dalam bingkai; empat angka statistik ringkas di bawahnya.
2. **Profil dan sejarah:** dua kolom asimetris; teks di satu sisi, foto dan garis waktu sejarah singkat di sisi lain.
3. **Visi dan misi:** kartu besar dengan latar hijau tua, teks putih hangat, daftar misi dengan ikon daun.
4. **Struktur organisasi:** kartu lurah lebih besar, perangkat lain dalam grid; bagan struktur di bawahnya.
5. **Wilayah dan statistik:** peta mini batas kelurahan di satu sisi, kartu statistik dan grafik di sisi lain.
6. **Peta interaktif:** peta lebar penuh dengan panel filter kategori di sisi kiri atau atas.
7. **Layanan:** kartu layanan dengan ikon, persyaratan ringkas, dan tombol "Lihat alur"; jam pelayanan ditampilkan menonjol.
8. **Potensi dan UMKM:** kartu produk dengan foto, nama usaha, dan tombol WhatsApp.
9. **Berita, pengumuman, agenda:** tiga kolom tidak sama lebar: satu berita utama besar, berita lain lebih kecil, agenda sebagai daftar tanggal.
10. **Galeri:** grid foto masonry dengan lightbox.
11. **Pengaduan dan kontak:** formulir di satu sisi, peta lokasi kantor, nomor telepon, WhatsApp, dan media sosial di sisi lain.
12. **Footer:** latar Hijau Tua, lambang, alamat, tautan cepat, jam pelayanan, hak cipta.

## Map Styling

- Peta dasar OpenStreetMap yang dilembutkan (opasitas atau filter saturasi sedikit diturunkan) agar selaras dengan palet.
- Batas kelurahan: garis 3px Hijau Daun, isian Hijau Lumut transparan 15%.
- Marker memakai ikon SVG per kategori di dalam lingkaran berwarna: pendidikan (Biru Langit), kesehatan (Tanah Liat), ibadah (Hijau Daun), pemerintahan (Hijau Tua), ekonomi dan UMKM (Kuning Surya, ikon Hijau Tua), infrastruktur (cokelat tanah #6B4226).
- Peta tematik (choropleth): skala lima tingkat dari hijau sangat muda (#E4F4EA) hingga Hijau Tua (#1B4332), dengan legenda dan angka.
- Popup: kartu putih radius 16px, judul Comfortaa, foto kecil, tombol detail.
- Kontrol zoom dan layer memakai tombol membulat dengan gaya yang sama dengan komponen.

## Admin Panel (Filament)

- Warna primer Filament diatur ke Hijau Daun; warna sukses Hijau Daun, peringatan Kuning Surya, info Biru Tautan, bahaya Tanah Liat.
- Font Nunito untuk seluruh panel, Comfortaa hanya untuk judul halaman dan angka widget.
- Sidebar putih hangat dengan item aktif berlatar hijau muda dan penanda Hijau Lumut di kiri.
- Widget dashboard memakai kartu statistik yang sama dengan landing page agar konsisten.
- Panel admin mengutamakan keterbacaan dan kerapatan data; ilustrasi dekoratif cukup di halaman login dan keadaan kosong.

## Motion

- **Masuk layar:** fade dan geser ke atas 16px menjadi 0 selama 500ms ease-out; daftar bertahap dengan jeda 100ms antaritem.
- **Hover:** naik 2px dan bayangan membesar selama 200ms; tombol tidak membesar berlebihan (maksimal scale 1,02).
- **Hiasan:** daun atau burung bergoyang sangat pelan (gerak 4 sampai 6px, durasi 6 sampai 8 detik); partikel daun jatuh bersifat opsional dan hanya di hero.
- **Angka statistik:** dihitung naik sekali saat pertama terlihat.
- Hanya properti transform dan opacity yang dianimasikan.
- Hormati prefers-reduced-motion: matikan semua animasi dekoratif dan tampilkan keadaan akhir.

## Imagery & Icons

- Foto asli kelurahan (kantor, jalan, kegiatan warga, UMKM) lebih diutamakan daripada foto stok. Gambar pengganti saat pengembangan boleh memakai picsum.photos.
- Ilustrasi hiasan (daun, burung, tanaman) berupa SVG sebaris, goresan tipis dan warna dari palet, ditandai aria-hidden. Tidak memakai emoji sebagai ilustrasi atau ikon.
- Ikon berupa SVG goresan tipis berukuran seragam, dengan satu gaya yang sama di seluruh situs.
- Semua gambar punya teks alternatif yang bermakna; foto dikompresi (WebP) dan dimuat bertahap (lazy loading).

## Accessibility

- Kontras teks minimal 4,5:1 untuk teks biasa dan 3:1 untuk teks besar.
- Fokus keyboard selalu terlihat (cincin 2px Hijau Lumut dengan offset 2px).
- Area sentuh minimal 44 x 44px.
- Ukuran teks isi tidak kurang dari 16px; tautan dan tombol bisa dibedakan tanpa bergantung pada warna saja.
- Struktur judul berurutan (satu H1 per halaman) dan landmark HTML yang benar.

## Implementation Notes (Laravel, Blade, Tailwind 4)

Token dipasang sebagai variabel tema Tailwind:

```css
@theme {
  --color-primary: #2D6A4F;
  --color-primary-dark: #1B4332;
  --color-secondary: #FFB703;
  --color-tertiary: #219EBC;
  --color-tertiary-dark: #17708A;
  --color-neutral: #FFF8E7;
  --color-accent: #52B788;
  --color-ink: #1F2D26;
  --color-sky: #8ECFEA;
  --color-danger: #B3361A;

  --font-display: "Comfortaa", system-ui, sans-serif;
  --font-sans: "Nunito", system-ui, sans-serif;

  --radius-organic: 36px 28px 40px 24px;
}
```

- Komponen Blade dipisah per bagian (hero, statistik, kartu, formulir) dan memakai kelas dari token di atas, bukan nilai warna langsung.
- Konten setiap bagian dan tema dasar (warna, logo, nama kelurahan) dibaca dari database sehingga dapat diubah admin tanpa mengubah kode.

## Do's and Don'ts

Do:

- Pakai sudut membulat, bentuk organik, dan hiasan tanaman secara hemat.
- Tampilkan angka dan peta sebagai bintang halaman; hiasan hanya pendukung.
- Pertahankan satu gaya ikon dan satu gaya ilustrasi.
- Tulis teks dalam bahasa Indonesia yang sederhana dan langsung.
- Uji tampilan di ponsel kelas menengah dan koneksi lambat.

Don't:

- Tidak memakai emoji di antarmuka; gunakan ikon SVG.
- Tidak memakai hitam murni (#000000).
- Tidak memakai warna neon atau saturasi di atas 80%.
- Tidak memakai tata letak tiga kolom sama lebar untuk bagian fitur.
- Tidak memakai h-screen; gunakan min-h-[100dvh].
- Tidak memakai klise salinan seperti "Elevate", "Seamless", "Unleash", atau "Next-Gen".
- Tidak memakai Kuning Surya sebagai warna teks di atas latar terang.
- Tidak memakai lorem ipsum pada demo; gunakan contoh konten kelurahan yang realistis.
- Tidak menampilkan data pribadi warga di halaman publik.

## Use Case

Landing page profil kelurahan, portal publik peta dan statistik wilayah, serta panel admin sistem informasi pemetaan kelurahan.