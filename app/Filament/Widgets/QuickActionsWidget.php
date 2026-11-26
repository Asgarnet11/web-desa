<?php

namespace App\Filament\Widgets;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
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

        $heading = match ($peran) {
            PeranUser::Pimpinan => 'Pusat Komando & Disposisi Eksekutif',
            PeranUser::Operator => 'Meja Kerja & Navigasi Operasional Loket',
            PeranUser::AdminWilayah => 'Supervisi Wilayah & Koordinasi Kewilayahan',
            PeranUser::SuperAdmin => 'Pusat Tata Kelola Sistem & Keamanan Data',
            default => 'Akses Cepat & Navigasi Operasional',
        };

        $subheading = match ($peran) {
            PeranUser::Pimpinan => 'Pintasan langsung pimpinan untuk memantau capaian program, meninjau peta wilayah, dan mengecek tindak lanjut aspirasi warga.',
            PeranUser::Operator => 'Aksi prioritas petugas loket: proses tiket pengaduan masuk, kurasi pendaftaran UMKM mandiri, dan kelola titik sarana GIS.',
            PeranUser::AdminWilayah => 'Peralatan monitoring tingkat kecamatan: supervisi batas RW, audit fisik sarana, dan pengawasan aspirasi kelurahan binaan.',
            PeranUser::SuperAdmin => 'Pengawasan sistem: kelola akun aparatur, pantau rekaman audit trail, atur master wilayah, dan cek integritas data.',
            default => 'Pintasan langsung bagi aparatur kelurahan untuk memperbarui informasi dan melayani warga.',
        };

        $actions = match ($peran) {
            PeranUser::Pimpinan => [
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'GIS Batas & Fasilitas',
                    'url' => '/peta',
                    'icon' => 'map',
                    'color' => 'sky',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Portal Publik Warga',
                    'sub' => 'Lihat Website Sukawarna',
                    'url' => '/',
                    'icon' => 'globe',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Aspirasi & Pengaduan',
                    'sub' => 'Disposisi Keluhan Warga',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'color' => 'amber',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} Perlu Aksi" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Demografi & Penduduk',
                    'sub' => 'Data Agregat & Piramida',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'color' => 'teal',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Kondisi Infrastruktur',
                    'sub' => 'Monitoring Jalan & Fisik',
                    'url' => '/admin/infrastrukturs',
                    'icon' => 'wrench',
                    'color' => 'indigo',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Struktur Aparatur',
                    'sub' => 'Bagan Organisasi Kelurahan',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
                    'color' => 'purple',
                    'badge' => null,
                    'external' => false,
                ],
            ],

            PeranUser::Operator => [
                [
                    'label' => 'Verifikasi Pengaduan',
                    'sub' => 'Tindak Lanjut Tiket Warga',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'color' => 'amber',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} Menunggu" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Kurasi UMKM Baru',
                    'sub' => 'Validasi Pendaftaran Warga',
                    'url' => '/admin/umkms',
                    'icon' => 'storefront',
                    'color' => 'orange',
                    'badge' => $umkmPending > 0 ? "{$umkmPending} Menunggu" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Input Titik Fasilitas',
                    'sub' => 'Tambah Sarana di Peta',
                    'url' => '/admin/fasilitas/create',
                    'icon' => 'map-pin',
                    'color' => 'teal',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Tulis Warta & Berita',
                    'sub' => 'Publikasi Kabar Kelurahan',
                    'url' => '/admin/beritas/create',
                    'icon' => 'newspaper',
                    'color' => 'indigo',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Unggah Blangko Layanan',
                    'sub' => 'Arsip Keterbukaan KIP',
                    'url' => '/admin/dokumen-publiks/create',
                    'icon' => 'document',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'Buka Navigasi GIS',
                    'url' => '/peta',
                    'icon' => 'map',
                    'color' => 'sky',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::AdminWilayah => [
                [
                    'label' => 'Master RW & Batas',
                    'sub' => 'Supervisi Polygon Spasial',
                    'url' => '/admin/wilayahs',
                    'icon' => 'map',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Wilayah',
                    'sub' => 'Monitoring Sebaran GIS',
                    'url' => '/peta',
                    'icon' => 'map-pin',
                    'color' => 'sky',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Evaluasi Sarana Publik',
                    'sub' => 'Sebaran Fasilitas RW',
                    'url' => '/admin/fasilitas',
                    'icon' => 'wrench',
                    'color' => 'teal',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Pantau Aduan Warga',
                    'sub' => 'Monitoring Wilayah Sukasari',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'color' => 'amber',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} Belum Tuntas" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Agregat Demografi',
                    'sub' => 'Statistik Warga Wilayah',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'color' => 'purple',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Portal Publik Warga',
                    'sub' => 'Cek Halaman Utama',
                    'url' => '/',
                    'icon' => 'globe',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => true,
                ],
            ],

            PeranUser::SuperAdmin => [
                [
                    'label' => 'Kelola Akun Aparatur',
                    'sub' => 'Hak Akses & Kredensial',
                    'url' => '/admin/users',
                    'icon' => 'users',
                    'color' => 'purple',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Audit Trail Log',
                    'sub' => 'Pencatatan Aktivitas',
                    'url' => '/admin/log-aktivitas',
                    'icon' => 'shield',
                    'color' => 'indigo',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Master Wilayah & GIS',
                    'sub' => 'Layer Polygon GeoJSON',
                    'url' => '/admin/wilayahs',
                    'icon' => 'map',
                    'color' => 'teal',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Profil Lembaga',
                    'sub' => 'Data Kelurahan & Kontak',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Validasi Peta GIS',
                    'sub' => 'Pratinjau Render Spasial',
                    'url' => '/peta',
                    'icon' => 'map-pin',
                    'color' => 'sky',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Repositori Dokumen',
                    'sub' => 'File & Berkas Publik',
                    'url' => '/admin/dokumen-publiks',
                    'icon' => 'document',
                    'color' => 'amber',
                    'badge' => null,
                    'external' => false,
                ],
            ],

            default => [
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'Buka GIS Publik',
                    'url' => '/peta',
                    'icon' => 'map',
                    'color' => 'sky',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Portal Warga',
                    'sub' => 'Lihat Beranda',
                    'url' => '/',
                    'icon' => 'globe',
                    'color' => 'emerald',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Aspirasi Warga',
                    'sub' => 'Verifikasi Keluhan',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'color' => 'amber',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Fasilitas Publik',
                    'sub' => 'Kelola Titik Peta',
                    'url' => '/admin/fasilitas',
                    'icon' => 'map-pin',
                    'color' => 'teal',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Tulis Berita',
                    'sub' => 'Rilis Informasi Baru',
                    'url' => '/admin/beritas/create',
                    'icon' => 'newspaper',
                    'color' => 'indigo',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Bagan Organisasi',
                    'sub' => 'Susunan Aparatur',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
                    'color' => 'purple',
                    'badge' => null,
                    'external' => false,
                ],
            ],
        };

        return [
            'heading' => $heading,
            'subheading' => $subheading,
            'actions' => $actions,
        ];
    }
}
