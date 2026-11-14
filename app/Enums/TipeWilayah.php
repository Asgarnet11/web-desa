<?php

namespace App\Enums;

enum TipeWilayah: string
{
    case Provinsi = 'provinsi';
    case KabupatenKota = 'kabupaten_kota';
    case Kecamatan = 'kecamatan';
    case Desa = 'desa';
    case Kelurahan = 'kelurahan';
    case Dusun = 'dusun';
    case Lingkungan = 'lingkungan';
    case RW = 'rw';
    case RT = 'rt';

    public function label(): string
    {
        return match ($this) {
            self::Provinsi => 'Provinsi',
            self::KabupatenKota => 'Kabupaten / Kota',
            self::Kecamatan => 'Kecamatan',
            self::Desa => 'Desa',
            self::Kelurahan => 'Kelurahan',
            self::Dusun => 'Dusun',
            self::Lingkungan => 'Lingkungan',
            self::RW => 'Rukun Warga (RW)',
            self::RT => 'Rukun Tetangga (RT)',
        };
    }
}

