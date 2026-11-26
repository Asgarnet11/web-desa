<?php

namespace App\Enums;

enum JenisMutasi: string
{
    case Kelahiran = 'kelahiran';
    case Kematian = 'kematian';
    case Datang = 'datang';
    case PindahKeluar = 'pindah_keluar';
    case PerubahanData = 'perubahan_data';

    public function label(): string
    {
        return match ($this) {
            self::Kelahiran => 'Kelahiran (Lahir)',
            self::Kematian => 'Kematian (Mati)',
            self::Datang => 'Kedatangan (Datang)',
            self::PindahKeluar => 'Kepindahan (Pindah Keluar)',
            self::PerubahanData => 'Perubahan Data / Pindah Lokal',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Kelahiran => 'success',
            self::Datang => 'info',
            self::PindahKeluar => 'warning',
            self::Kematian => 'danger',
            self::PerubahanData => 'gray',
        };
    }

    public function prefixSurat(): string
    {
        return match ($this) {
            self::Kelahiran => 'SKL',
            self::Kematian => 'SKK',
            self::Datang => 'SKD',
            self::PindahKeluar => 'SKP',
            self::PerubahanData => 'DOM',
        };
    }
}
