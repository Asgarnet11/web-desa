<?php

namespace App\Enums;

enum StatusVerifikasi: string
{
    case Draf = 'draf';
    case Diajukan = 'diajukan';
    case Terverifikasi = 'terverifikasi';
    case Ditolak = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::Draf => 'Draf',
            self::Diajukan => 'Diajukan',
            self::Terverifikasi => 'Terverifikasi',
            self::Ditolak => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draf => 'gray',
            self::Diajukan => 'warning',
            self::Terverifikasi => 'success',
            self::Ditolak => 'danger',
        };
    }
}

