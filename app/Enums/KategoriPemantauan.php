<?php

namespace App\Enums;

enum KategoriPemantauan: string
{
    case IbuHamil = 'ibu_hamil';
    case BalitaGizi = 'balita_gizi';
    case LansiaRentan = 'lansia_rentan';
    case Disabilitas = 'disabilitas';

    public function label(): string
    {
        return match ($this) {
            self::IbuHamil => 'Ibu Hamil',
            self::BalitaGizi => 'Balita & Pemantauan Gizi',
            self::LansiaRentan => 'Lansia Rentan',
            self::Disabilitas => 'Penyandang Disabilitas',
        };
    }
}
