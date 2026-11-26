<?php

namespace App\Enums;

enum StatusKependudukan: string
{
    case Tetap = 'tetap';
    case Sementara = 'sementara';
    case PindahKeluar = 'pindah_keluar';
    case Meninggal = 'meninggal';

    public function label(): string
    {
        return match ($this) {
            self::Tetap => 'Penduduk Tetap',
            self::Sementara => 'Penduduk Sementara / Domisili',
            self::PindahKeluar => 'Pindah Keluar',
            self::Meninggal => 'Meninggal Dunia',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Tetap => 'success',
            self::Sementara => 'info',
            self::PindahKeluar => 'warning',
            self::Meninggal => 'gray',
        };
    }
}
