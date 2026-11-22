<?php

namespace App\Enums;

enum StatusKonten: string
{
    case Draf = 'draf';
    case Terbit = 'terbit';

    public function label(): string
    {
        return match ($this) {
            self::Draf => 'Draf',
            self::Terbit => 'Terbit',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draf => 'gray',
            self::Terbit => 'success',
        };
    }
}
