<?php

namespace App\Enums;

enum PeranUser: string
{
    case SuperAdmin = 'super_admin';
    case AdminWilayah = 'admin_wilayah';
    case Operator = 'operator';
    case Pimpinan = 'pimpinan';
    case KetuaRtRw = 'ketua_rt_rw';
    case KaderKesehatan = 'kader_kesehatan';
    case Publik = 'publik';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::AdminWilayah => 'Admin Wilayah',
            self::Operator => 'Operator Desa/Kelurahan',
            self::Pimpinan => 'Pimpinan (Kepala Desa / Lurah / Camat)',
            self::KetuaRtRw => 'Ketua RT / RW',
            self::KaderKesehatan => 'Kader Kesehatan / Posyandu',
            self::Publik => 'Masyarakat / Publik',
        };
    }
}
