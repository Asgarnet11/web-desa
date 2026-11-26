<?php

namespace App\Filament\Pages;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Models\Pengaduan;
use App\Models\Umkm;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'lg' => 3,
        ];
    }

    public function getHeading(): string|Htmlable
    {
        return match (Auth::user()?->peran) {
            PeranUser::Pimpinan => 'Ringkasan Eksekutif Wilayah',
            PeranUser::Operator => 'Meja Kerja Pelayanan Warga',
            PeranUser::AdminWilayah => 'Supervisi Kecamatan Sukasari',
            PeranUser::SuperAdmin => 'Tata Kelola & Keamanan Sistem',
            default => 'Pusat Administrasi Sukawarna',
        };
    }

    public function getSubheading(): ?string
    {
        $user = Auth::user();
        $peran = $user?->peran;

        $pendingAduan = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pendingUmkm = Umkm::where('is_publik', false)->count();
        $totalAduan = Pengaduan::count();
        $selesaiAduan = Pengaduan::where('status', StatusPengaduan::Selesai)->count();
        $persenSelesai = $totalAduan > 0 ? (int) round(($selesaiAduan / $totalAduan) * 100) : 100;

        return match ($peran) {
            PeranUser::Pimpinan => "{$user->name} — Tingkat penyelesaian aspirasi warga saat ini {$persenSelesai}% ({$selesaiAduan} dari {$totalAduan} laporan tuntas).",
            PeranUser::Operator => "{$user->name} — {$pendingAduan} aduan warga menunggu verifikasi dan {$pendingUmkm} pengajuan UMKM menunggu kurasi.",
            PeranUser::AdminWilayah => "{$user->name} — Pengawasan lintas RW Kelurahan Sukawarna beserta kondisi infrastruktur dan sebaran fasilitas.",
            PeranUser::SuperAdmin => "{$user->name} — Pemantauan hak akses aparatur, rekaman audit mutasi data, dan integritas layer GeoJSON.",
            default => $user?->name ?? 'Portal Administrasi Kelurahan Sukawarna',
        };
    }

    protected function getHeaderActions(): array
    {
        $peran = Auth::user()?->peran;

        $primaryAction = match ($peran) {
            PeranUser::Operator => Action::make('verifikasiAduan')
                ->label('Proses Verifikasi Aduan')
                ->url('/admin/pengaduans')
                ->color('primary'),
            PeranUser::Pimpinan => Action::make('tinjauAspirasi')
                ->label('Tinjau Disposisi Aduan')
                ->url('/admin/pengaduans')
                ->color('primary'),
            PeranUser::AdminWilayah => Action::make('bukaMasterWilayah')
                ->label('Kelola Batas RW')
                ->url('/admin/wilayahs')
                ->color('primary'),
            PeranUser::SuperAdmin => Action::make('kelolaPengguna')
                ->label('Kelola Akun Aparatur')
                ->url('/admin/users')
                ->color('primary'),
            default => null,
        };

        $actions = [
            Action::make('bukaPeta')
                ->label('Peta Spasial GIS')
                ->url('/peta', shouldOpenInNewTab: true)
                ->color('gray')
                ->outlined(),
        ];

        if ($primaryAction !== null) {
            $actions[] = $primaryAction;
        }

        return $actions;
    }
}
