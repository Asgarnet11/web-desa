<?php

namespace App\Enums;

enum TingkatRisikoKesehatan: string
{
    case Normal = 'normal';
    case Kek = 'kek';
    case RisikoTinggi = 'risiko_tinggi';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Kondisi Terpantau Normal',
            self::Kek => 'KEK / Perlu Intervensi Gizi',
            self::RisikoTinggi => 'Risiko Tinggi (Resti)',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Normal => 'success',
            self::Kek => 'warning',
            self::RisikoTinggi => 'danger',
        };
    }
}
