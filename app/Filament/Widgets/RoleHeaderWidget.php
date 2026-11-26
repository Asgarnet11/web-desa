<?php

namespace App\Filament\Widgets;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Models\Pengaduan;
use App\Models\Umkm;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class RoleHeaderWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = -10;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.role-header-widget';

    public function getViewData(): array
    {
        $user = Auth::user();
        $peran = $user?->peran;

        $roleBadge = match ($peran) {
            PeranUser::Pimpinan => [
                'label' => 'Pimpinan Wilayah / Lurah',
                'bg' => 'bg-amber-100 text-amber-900 border-amber-300 dark:bg-amber-950/60 dark:text-amber-200 dark:border-amber-700',
                'icon' => '👑',
                'color' => '#D97706',
            ],
            PeranUser::Operator => [
                'label' => 'Operator Pelayanan & Loket',
                'bg' => 'bg-sky-100 text-sky-900 border-sky-300 dark:bg-sky-950/60 dark:text-sky-200 dark:border-sky-700',
                'icon' => '💼',
                'color' => '#0284C7',
            ],
            PeranUser::AdminWilayah => [
                'label' => 'Admin Wilayah / Kecamatan Sukasari',
                'bg' => 'bg-emerald-100 text-emerald-900 border-emerald-300 dark:bg-emerald-950/60 dark:text-emerald-200 dark:border-emerald-700',
                'icon' => '🏛️',
                'color' => '#059669',
            ],
            PeranUser::SuperAdmin => [
                'label' => 'Super Administrator Sistem',
                'bg' => 'bg-purple-100 text-purple-900 border-purple-300 dark:bg-purple-950/60 dark:text-purple-200 dark:border-purple-700',
                'icon' => '⚡',
                'color' => '#7C3AED',
            ],
            default => [
                'label' => 'Aparatur Kelurahan',
                'bg' => 'bg-gray-100 text-gray-800 border-gray-300 dark:bg-gray-800 dark:text-gray-200',
                'icon' => '👤',
                'color' => '#1B4332',
            ],
        };

        $roleDescription = match ($peran) {
            PeranUser::Pimpinan => 'Ruang Kendali Eksekutif Kelurahan Sukawarna. Mengawasi capaian program prioritas, indeks kecepatan tindak lanjut aspirasi warga, dan disposisi strategis.',
            PeranUser::Operator => 'Meja Kerja Operasional Pelayanan Warga. Fokus pada pemrosesan tiket pengaduan masuk, kurasi UMKM baru, validasi berkas Fast-Track, dan pembaruan data spasial.',
            PeranUser::AdminWilayah => 'Panel Pengawasan & Supervisi Kewilayahan Kecamatan Sukasari. Memantau integrasi data kelurahan binaan, kondisi infrastruktur fisik, dan pemerataan fasilitas publik.',
            PeranUser::SuperAdmin => 'Pusat Tata Kelola Sistem, Keamanan & Integritas Basis Data. Mengelola akun aparatur, perizinan akses, pemantauan audit trail real-time, dan master data GeoJSON.',
            default => 'Selamat bertugas melayani masyarakat Kelurahan Sukawarna.',
        };

        // Pending operational tasks for counter badges
        $pendingPengaduan = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pendingUmkm = Umkm::where('is_publik', false)->count();

        return [
            'user' => $user,
            'roleBadge' => $roleBadge,
            'roleDescription' => $roleDescription,
            'pendingPengaduan' => $pendingPengaduan,
            'pendingUmkm' => $pendingUmkm,
        ];
    }
}
