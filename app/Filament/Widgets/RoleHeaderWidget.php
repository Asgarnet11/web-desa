<?php

namespace App\Filament\Widgets;

use App\Enums\KategoriPemantauan;
use App\Enums\PeranUser;
use App\Enums\StatusPengaduan;
use App\Enums\StatusVerifikasi;
use App\Enums\TingkatRisikoKesehatan;
use App\Models\LogAktivitas;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
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
            PeranUser::KetuaRtRw => 'Ketua RT / RW · '.$user?->wilayah?->nama,
            PeranUser::KaderKesehatan => 'Kader Kesehatan / Posyandu',
            PeranUser::AdminWilayah => 'Admin Wilayah / Kecamatan Sukasari',
            PeranUser::SuperAdmin => 'Super Administrator Sistem',
            default => 'Aparatur Kelurahan',
        };

        $roleContext = match ($peran) {
            PeranUser::Pimpinan => 'Ruang Kendali Eksekutif · Memantau real-time agregat Adminduk, indeks kesehatan keluarga, dan tindak lanjut aspirasi.',
            PeranUser::Operator => 'Meja Kerja Operasional · Pengesahan mutasi LAMPID, kurasi UMKM mandiri, dan verifikasi tiket pengaduan warga.',
            PeranUser::KetuaRtRw => 'Kanal Pelaporan Wilayah · Pencatatan warga datang/keluar/lahir/wafat pada lingkup wilayah binaan RT/RW.',
            PeranUser::KaderKesehatan => 'Akses Terbatas UU PDP · Pemantauan aktif Ibu Hamil (KEK/Resti), Balita Posyandu, dan Lansia Rentan.',
            PeranUser::AdminWilayah => 'Supervisi Kewilayahan · Memantau agregat kependudukan per kelurahan & RW tanpa membuka data NIK individu.',
            PeranUser::SuperAdmin => 'Pusat Tata Kelola & Keamanan · Pengendalian hak akses, audit log ter-redaksi UU PDP, dan master batas GeoJSON.',
            default => 'Sistem Administrasi & Geospasial Kelurahan Sukawarna.',
        };

        $pendingPengaduan = Pengaduan::where('status', StatusPengaduan::Menunggu)->count();
        $pendingUmkm = Umkm::where('is_publik', false)->count();
        $pendingMutasi = MutasiPenduduk::forCurrentUserWilayah()->where('status_verifikasi', StatusVerifikasi::Diajukan->value)->count();
        $bumilResti = PemantauanKesehatan::forCurrentUserWilayah()
            ->sedangAktif()
            ->where('kategori', KategoriPemantauan::IbuHamil->value)
            ->whereIn('status_risiko', [TingkatRisikoKesehatan::Kek->value, TingkatRisikoKesehatan::RisikoTinggi->value])
            ->count();
        $latestLog = LogAktivitas::latest('id')->first();

        return [
            'user' => $user,
            'roleBadge' => $roleBadge,
            'roleContext' => $roleContext,
            'pendingPengaduan' => $pendingPengaduan,
            'pendingUmkm' => $pendingUmkm,
            'pendingMutasi' => $pendingMutasi,
            'bumilResti' => $bumilResti,
            'latestLog' => $latestLog,
        ];
    }
}
