<?php

namespace App\Filament\Pages;

use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Enums\StatusVerifikasi;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
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
            PeranUser::KetuaRtRw => 'Pelaporan Warga RT / RW',
            PeranUser::KaderKesehatan => 'Pemantauan Posyandu & Keluarga',
            PeranUser::AdminWilayah => 'Supervisi Kecamatan Konda',
            PeranUser::SuperAdmin => 'Tata Kelola & Keamanan Sistem',
            default => 'Pusat Administrasi Konda',
        };
    }

    public function getSubheading(): ?string
    {
        $user = Auth::user();
        $peran = $user?->peran;

        $pendingAduan = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pendingUmkm = Umkm::where('is_publik', false)->count();
        $pendingMutasi = MutasiPenduduk::forCurrentUserWilayah()->where('status_verifikasi', StatusVerifikasi::Diajukan->value)->count();
        $bumilAktif = PemantauanKesehatan::forCurrentUserWilayah()->sedangAktif()->where('kategori', 'ibu_hamil')->count();
        $totalAduan = Pengaduan::count();
        $selesaiAduan = Pengaduan::where('status', StatusPengaduan::Selesai)->count();
        $persenSelesai = $totalAduan > 0 ? (int) round(($selesaiAduan / $totalAduan) * 100) : 100;

        return match ($peran) {
            PeranUser::Pimpinan => "{$user->name} — Tingkat penyelesaian aspirasi warga {$persenSelesai}% ({$selesaiAduan}/{$totalAduan} tuntas) serta sinkronisasi Adminduk & Posyandu berjalan.",
            PeranUser::Operator => "{$user->name} — {$pendingMutasi} mutasi LAMPID, {$pendingAduan} aduan warga, dan {$pendingUmkm} UMKM menunggu verifikasi.",
            PeranUser::KetuaRtRw => "{$user->name} — Pelaporan peristiwa warga datang, pindah keluar, lahir, dan wafat di lingkup RT/RW Anda.",
            PeranUser::KaderKesehatan => "{$user->name} — Tercatat {$bumilAktif} ibu hamil aktif dalam pemantauan berkala dan intervensi Posyandu wilayah.",
            PeranUser::AdminWilayah => "{$user->name} — Pengawasan lintas RW Kelurahan Konda beserta kondisi infrastruktur dan sebaran fasilitas.",
            PeranUser::SuperAdmin => "{$user->name} — Pemantauan hak akses aparatur, redaksi audit UU PDP, dan integritas layer GeoJSON.",
            default => $user?->name ?? 'Portal Administrasi Kelurahan Konda',
        };
    }

    protected function getHeaderActions(): array
    {
        $peran = Auth::user()?->peran;

        $primaryAction = match ($peran) {
            PeranUser::Operator => Action::make('verifikasiMutasi')
                ->label('Verifikasi Mutasi LAMPID')
                ->url('/admin/mutasi-penduduks')
                ->color('primary'),
            PeranUser::Pimpinan => Action::make('tinjauAspirasi')
                ->label('Tinjau Disposisi Aduan')
                ->url('/admin/pengaduans')
                ->color('primary'),
            PeranUser::KetuaRtRw => Action::make('laporMutasi')
                ->label('Laporkan Mutasi Warga')
                ->url('/admin/mutasi-penduduks/create')
                ->color('primary'),
            PeranUser::KaderKesehatan => Action::make('catatKesehatan')
                ->label('Catat Ibu Hamil / Balita')
                ->url('/admin/pemantauan-kesehatans/create')
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
