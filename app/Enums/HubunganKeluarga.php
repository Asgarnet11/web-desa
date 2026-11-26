<?php

namespace App\Enums;

enum HubunganKeluarga: string
{
    case KepalaKeluarga = 'kepala_keluarga';
    case Istri = 'istri';
    case Anak = 'anak';
    case OrangTua = 'orang_tua';
    case FamiliLain = 'famili_lain';

    public function label(): string
    {
        return match ($this) {
            self::KepalaKeluarga => 'Kepala Keluarga',
            self::Istri => 'Istri',
            self::Anak => 'Anak',
            self::OrangTua => 'Orang Tua / Mertua',
            self::FamiliLain => 'Famili Lain / Numpang KK',
        };
    }
}
