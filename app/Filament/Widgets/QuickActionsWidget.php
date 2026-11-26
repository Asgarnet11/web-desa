<?php

namespace App\Filament\Widgets;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Enums\StatusVerifikasi;
use App\Models\MutasiPenduduk;
use App\Models\Pengaduan;
use App\Models\Umkm;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class QuickActionsWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.quick-actions-widget';

    public function getViewData(): array
    {
        $user = Auth::user();
        $peran = $user?->peran;

        $pengaduanMenunggu = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $umkmPending = Umkm::where('is_publik', false)->count();
        $mutasiPending = MutasiPenduduk::forCurrentUserWilayah()->where('status_verifikasi', StatusVerifikasi::Diajukan->value)->count();

        $heading = match ($peran) {
            PeranUser::Pimpinan => 'Pusat Komando & Disposisi Eksekutif',
            PeranUser::Operator => 'Meja Kerja & Navigasi Operasional Loket',
            PeranUser::KetuaRtRw => 'Pelayanan & Pencatatan Wilayah RT/RW',
            PeranUser::KaderKesehatan => 'Posyandu & Pemantauan Keluarga',
            PeranUser::AdminWilayah => 'Supervisi Wilayah & Koordinasi Kewilayahan',
            PeranUser::SuperAdmin => 'Pusat Tata Kelola Sistem & Keamanan Data',
            default => 'Akses Cepat & Navigasi Operasional',
        };

        $subheading = match ($peran) {
            PeranUser::Pimpinan => 'Akses langsung pimpinan untuk pemantauan Adminduk agregat, peta wilayah, dan tindak lanjut aspirasi warga.',
            PeranUser::Operator => 'Pintasan prioritas loket: pengesahan mutasi LAMPID, kurasi UMKM, buku induk, dan verifikasi pengaduan.',
            PeranUser::KetuaRtRw => 'Catat kedatangan warga baru, pindah keluar, kelahiran, atau kematian langsung dari lingkup RT/RW Anda.',
            PeranUser::KaderKesehatan => 'Catat dan pantau Ibu Hamil (KEK/Resti), Balita Posyandu, serta ajukan laporan kelahiran saat bersalin.',
            PeranUser::AdminWilayah => 'Alat monitoring tingkat kecamatan: supervisi batas RW, kondisi sarana, dan agregat wilayah.',
            PeranUser::SuperAdmin => 'Administrasi inti sistem: manajemen akun aparatur, log audit trail UU PDP, dan master GeoJSON.',
            default => 'Navigasi cepat aparatur untuk memperbarui data dan melayani warga.',
        };

        $actions = match ($peran) {
            PeranUser::Pimpinan => [
                [
                    'label' => 'Agregat Demografi Wilayah',
                    'sub' => 'Rekapitulasi jiwa, KK & LAMPID per RW',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Aspirasi & Pengaduan',
                    'sub' => 'Disposisi keluhan warga',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} perlu aksi" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Buku Mutasi (LAMPID)',
                    'sub' => 'Pantau pengesahan lahir/datang/pindah',
                    'url' => '/admin/mutasi-penduduks',
                    'icon' => 'document',
                    'badge' => $mutasiPending > 0 ? "{$mutasiPending} diajukan" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'GIS batas wilayah & sebaran penduduk',
                    'url' => '/peta',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Kondisi Infrastruktur',
                    'sub' => 'Monitoring jalan & prasarana',
                    'url' => '/admin/infrastrukturs',
                    'icon' => 'wrench',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Portal Publik Warga',
                    'sub' => 'Tinjau situs resmi Sukawarna',
                    'url' => '/',
                    'icon' => 'globe',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::Operator => [
                [
                    'label' => 'Verifikasi Mutasi LAMPID',
                    'sub' => 'Sahkan laporan lahir, datang, pindah, mati',
                    'url' => '/admin/mutasi-penduduks',
                    'icon' => 'document',
                    'badge' => $mutasiPending > 0 ? "{$mutasiPending} menunggu" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Buku Induk & Import CSV',
                    'sub' => 'Kelola warga & unggah BIP SIAK',
                    'url' => '/admin/penduduks',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Kartu Keluarga (KK)',
                    'sub' => 'Data domisili KK & alamat RT/RW',
                    'url' => '/admin/kartu-keluargas',
                    'icon' => 'building',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Ibu Hamil & Kesehatan',
                    'sub' => 'Pantau sasaran Posyandu & HPL',
                    'url' => '/admin/pemantauan-kesehatans',
                    'icon' => 'shield',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Verifikasi Pengaduan',
                    'sub' => 'Tindak lanjuti tiket masuk warga',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} menunggu" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Kurasi UMKM Baru',
                    'sub' => 'Validasi pendaftaran usaha warga',
                    'url' => '/admin/umkms',
                    'icon' => 'storefront',
                    'badge' => $umkmPending > 0 ? "{$umkmPending} menunggu" : null,
                    'external' => false,
                ],
            ],

            PeranUser::KetuaRtRw => [
                [
                    'label' => 'Laporkan Mutasi Baru',
                    'sub' => 'Ajukan lahir, warga datang, pindah, wafat',
                    'url' => '/admin/mutasi-penduduks/create',
                    'icon' => 'document',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Daftar Pengajuan Mutasi',
                    'sub' => 'Pantau status verifikasi kelurahan',
                    'url' => '/admin/mutasi-penduduks',
                    'icon' => 'chat',
                    'badge' => $mutasiPending > 0 ? "{$mutasiPending} diproses" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Buku Induk Wilayah',
                    'sub' => 'Lihat warga tetap & sementara RT/RW',
                    'url' => '/admin/penduduks',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Daftar Kartu Keluarga',
                    'sub' => 'Direktori KK aktif lingkup binaan',
                    'url' => '/admin/kartu-keluargas',
                    'icon' => 'building',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Wilayah',
                    'sub' => 'Tinjau sebaran wilayah GIS',
                    'url' => '/peta',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Portal Warga',
                    'sub' => 'Buka halaman utama kelurahan',
                    'url' => '/',
                    'icon' => 'globe',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::KaderKesehatan => [
                [
                    'label' => 'Catat Ibu Hamil / Balita',
                    'sub' => 'Input kehamilan baru, KEK & HPL',
                    'url' => '/admin/pemantauan-kesehatans/create',
                    'icon' => 'shield',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Daftar Pemantauan Aktif',
                    'sub' => 'Filter HPL bulan ini & risiko tinggi',
                    'url' => '/admin/pemantauan-kesehatans',
                    'icon' => 'document',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Laporkan Kelahiran Bayi',
                    'sub' => 'Otomatis menutup status hamil ibu',
                    'url' => '/admin/mutasi-penduduks/create',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Cari Warga / Ibu Terdaftar',
                    'sub' => 'Lihat data penduduk (NIK tersamar)',
                    'url' => '/admin/penduduks',
                    'icon' => 'building',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Agregat Demografi',
                    'sub' => 'Rekapitulasi kesehatan per RW',
                    'url' => '/admin/demografis',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Posyandu & Faskes',
                    'sub' => 'Buka sebaran fasilitas di peta GIS',
                    'url' => '/peta',
                    'icon' => 'map-pin',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::AdminWilayah => [
                [
                    'label' => 'Master RW & Batas',
                    'sub' => 'Supervisi polygon kewilayahan',
                    'url' => '/admin/wilayahs',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Agregat Demografi',
                    'sub' => 'Statistik warga lintas RW (Non-PII)',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Evaluasi Sarana Publik',
                    'sub' => 'Sebaran fasilitas per RW',
                    'url' => '/admin/fasilitas',
                    'icon' => 'wrench',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Pantau Aduan Warga',
                    'sub' => 'Monitoring tingkat kecamatan',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} terbuka" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Wilayah',
                    'sub' => 'Buka visualisasi GIS Sukasari',
                    'url' => '/peta',
                    'icon' => 'map-pin',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Portal Publik Warga',
                    'sub' => 'Cek halaman informasi publik',
                    'url' => '/',
                    'icon' => 'globe',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::SuperAdmin => [
                [
                    'label' => 'Kelola Akun Aparatur',
                    'sub' => 'Hak akses & peran RT/RW/Kader',
                    'url' => '/admin/users',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Audit Trail Log',
                    'sub' => 'Penelusuran mutasi & proteksi PII',
                    'url' => '/admin/log-aktivitas',
                    'icon' => 'shield',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Master Wilayah & GIS',
                    'sub' => 'Konfigurasi layer GeoJSON RW/RT',
                    'url' => '/admin/wilayahs',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Buku Induk & LAMPID',
                    'sub' => 'Kontrol ledger kependudukan penuh',
                    'url' => '/admin/mutasi-penduduks',
                    'icon' => 'document',
                    'badge' => $mutasiPending > 0 ? "{$mutasiPending} menunggu" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Profil Lembaga',
                    'sub' => 'Data resmi kelurahan & kontak',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Validasi Peta GIS',
                    'sub' => 'Pratinjau render peta interaktif',
                    'url' => '/peta',
                    'icon' => 'map-pin',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            default => [],
        };

        return [
            'heading' => $heading,
            'subheading' => $subheading,
            'actions' => $actions,
        ];
    }
}
