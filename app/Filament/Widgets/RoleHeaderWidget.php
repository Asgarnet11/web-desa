<?php

namespace App\Filament\Widgets;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Models\LogAktivitas;
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
            PeranUser::Pimpinan => 'Pimpinan Wilayah / Lurah',
            PeranUser::Operator => 'Operator Pelayanan & Loket',
            PeranUser::AdminWilayah => 'Admin Wilayah / Kecamatan Sukasari',
            PeranUser::SuperAdmin => 'Super Administrator Sistem',
            default => 'Aparatur Kelurahan',
        };

        $roleContext = match ($peran) {
            PeranUser::Pimpinan => 'Ruang Kendali Eksekutif · Fokus pada rasio tindak lanjut aspirasi, kondisi prasarana fisik, dan keterbukaan publik.',
            PeranUser::Operator => 'Meja Kerja Operasional · Prioritas pada verifikasi tiket pengaduan masuk, kurasi UMKM mandiri, dan input peta GIS.',
            PeranUser::AdminWilayah => 'Supervisi Kewilayahan · Memantau agregat kependudukan, sebaran sarana per RW, dan aspirasi tingkat kecamatan.',
            PeranUser::SuperAdmin => 'Pusat Tata Kelola & Keamanan · Pengendalian akun aparatur, validasi GeoJSON batas wilayah, dan log audit sistem.',
            default => 'Sistem Administrasi & Geospasial Kelurahan Sukawarna.',
        };

        $pendingPengaduan = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pendingUmkm = Umkm::where('is_publik', false)->count();
        $latestLog = LogAktivitas::latest('id')->first();

        return [
            'user' => $user,
            'roleBadge' => $roleBadge,
            'roleContext' => $roleContext,
            'pendingPengaduan' => $pendingPengaduan,
            'pendingUmkm' => $pendingUmkm,
            'latestLog' => $latestLog,
        ];
    }
}
