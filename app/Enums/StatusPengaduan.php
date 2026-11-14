<?php

namespace App\Enums;

enum StatusPengaduan: string
{
    case Menunggu = 'menunggu';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Ditolak = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::Menunggu => 'Menunggu Verifikasi',
            self::Diproses => 'Sedang Diproses',
            self::Selesai => 'Selesai Ditindaklanjuti',
            self::Ditolak => 'Ditolak / Tidak Valid',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Menunggu => 'warning',
            self::Diproses => 'info',
            self::Selesai => 'success',
            self::Ditolak => 'danger',
        };
    }
}
