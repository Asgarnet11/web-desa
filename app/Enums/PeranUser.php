<?php

namespace App\Enums;

enum PeranUser: string
{
    case SuperAdmin = 'super_admin';
    case AdminWilayah = 'admin_wilayah';
    case Operator = 'operator';
    case Pimpinan = 'pimpinan';
    case Publik = 'publik';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::AdminWilayah => 'Admin Wilayah',
            self::Operator => 'Operator Desa/Kelurahan',
            self::Pimpinan => 'Pimpinan (Kepala Desa / Lurah / Camat)',
            self::Publik => 'Masyarakat / Publik',
        };
    }
}

