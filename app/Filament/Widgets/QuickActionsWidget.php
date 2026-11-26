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
            PeranUser::Pimpinan => 'Akses langsung pimpinan untuk pemantauan program, peta wilayah, dan tindak lanjut aspirasi warga.',
            PeranUser::Operator => 'Pintasan prioritas loket: verifikasi aduan masuk, kurasi pendaftaran UMKM, dan pengelolaan titik GIS.',
            PeranUser::AdminWilayah => 'Alat monitoring tingkat kecamatan: supervisi batas RW, kondisi sarana, dan pengawasan wilayah.',
            PeranUser::SuperAdmin => 'Administrasi inti sistem: manajemen akun aparatur, log audit trail, dan master batas GeoJSON.',
            default => 'Navigasi cepat aparatur untuk memperbarui data dan melayani warga.',
        };

        $actions = match ($peran) {
            PeranUser::Pimpinan => [
                [
                    'label' => 'Aspirasi & Pengaduan',
                    'sub' => 'Disposisi keluhan warga',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'badge' => $pengaduanMenunggu > 0 ? "{$pengaduanMenunggu} perlu aksi" : null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'GIS batas wilayah & fasilitas',
                    'url' => '/peta',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Demografi & Penduduk',
                    'sub' => 'Data agregat & kependudukan',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
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
                    'label' => 'Struktur Aparatur',
                    'sub' => 'Profil & bagan organisasi',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
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
                [
                    'label' => 'Input Titik Fasilitas',
                    'sub' => 'Tambah lokasi sarana ke peta',
                    'url' => '/admin/fasilitas/create',
                    'icon' => 'map-pin',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Tulis Warta & Berita',
                    'sub' => 'Publikasi informasi kelurahan',
                    'url' => '/admin/beritas/create',
                    'icon' => 'newspaper',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Unggah Blangko Layanan',
                    'sub' => 'Perbarui arsip dokumen KIP',
                    'url' => '/admin/dokumen-publiks/create',
                    'icon' => 'document',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'Buka tampilan GIS publik',
                    'url' => '/peta',
                    'icon' => 'map',
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
                    'label' => 'Agregat Demografi',
                    'sub' => 'Statistik warga Sukasari',
                    'url' => '/admin/demografis',
                    'icon' => 'users',
                    'badge' => null,
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
                    'sub' => 'Hak akses & manajemen peran',
                    'url' => '/admin/users',
                    'icon' => 'users',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Audit Trail Log',
                    'sub' => 'Penelusuran riwayat mutasi data',
                    'url' => '/admin/log-aktivitas',
                    'icon' => 'shield',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Master Wilayah & GIS',
                    'sub' => 'Konfigurasi layer GeoJSON',
                    'url' => '/admin/wilayahs',
                    'icon' => 'map',
                    'badge' => null,
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
                    'label' => 'Repositori Dokumen',
                    'sub' => 'Berkas regulasi & file publik',
                    'url' => '/admin/dokumen-publiks',
                    'icon' => 'document',
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

            default => [
                [
                    'label' => 'Aspirasi Warga',
                    'sub' => 'Verifikasi keluhan masuk',
                    'url' => '/admin/pengaduans',
                    'icon' => 'chat',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Fasilitas Publik',
                    'sub' => 'Kelola titik koordinat GIS',
                    'url' => '/admin/fasilitas',
                    'icon' => 'map-pin',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Tulis Berita',
                    'sub' => 'Rilis informasi kelurahan',
                    'url' => '/admin/beritas/create',
                    'icon' => 'newspaper',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Bagan Organisasi',
                    'sub' => 'Susunan profil aparatur',
                    'url' => '/admin/profil-kelurahans',
                    'icon' => 'building',
                    'badge' => null,
                    'external' => false,
                ],
                [
                    'label' => 'Peta Spasial Digital',
                    'sub' => 'Buka tampilan GIS publik',
                    'url' => '/peta',
                    'icon' => 'map',
                    'badge' => null,
                    'external' => true,
                ],
                [
                    'label' => 'Portal Warga',
                    'sub' => 'Lihat website utama',
                    'url' => '/',
                    'icon' => 'globe',
                    'badge' => null,
                    'external' => true,
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
