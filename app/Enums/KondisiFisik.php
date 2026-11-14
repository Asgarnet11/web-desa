<?php

namespace App\Enums;

enum KondisiFisik: string
{
    case Baik = 'baik';
    case RusakRingan = 'rusak_ringan';
    case RusakSedang = 'rusak_sedang';
    case RusakBerat = 'rusak_berat';

    public function label(): string
    {
        return match ($this) {
            self::Baik => 'Baik',
            self::RusakRingan => 'Rusak Ringan',
            self::RusakSedang => 'Rusak Sedang',
            self::RusakBerat => 'Rusak Berat',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Baik => 'success',
            self::RusakRingan => 'warning',
            self::RusakSedang => 'warning',
            self::RusakBerat => 'danger',
        };
    }
}

