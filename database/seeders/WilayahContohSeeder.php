<?php

namespace Database\Seeders;

use App\Enums\TipeWilayah;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahContohSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Provinsi
        $provinsi = Wilayah::firstOrCreate(
            ['kode' => '32'],
            [
                'tipe' => TipeWilayah::Provinsi,
                'nama' => 'Jawa Barat',
                'lat' => -6.914744,
                'lng' => 107.609810,
            ]
        );

        // 2. Kota
        $kota = Wilayah::firstOrCreate(
            ['kode' => '32.73'],
            [
                'parent_id' => $provinsi->id,
                'tipe' => TipeWilayah::KabupatenKota,
                'nama' => 'Kota Bandung',
                'lat' => -6.917464,
                'lng' => 107.619123,
                'luas' => 167.31,
            ]
        );

        // 3. Kecamatan
        $kecamatan = Wilayah::firstOrCreate(
            ['kode' => '32.73.01'],
            [
                'parent_id' => $kota->id,
                'tipe' => TipeWilayah::Kecamatan,
                'nama' => 'Sukasari',
                'lat' => -6.871234,
                'lng' => 107.584321,
                'luas' => 6.27,
            ]
        );

        // 4. Kelurahan Sukawarna
        $geojsonBatas = [
            'type' => 'Feature',
            'properties' => [
                'nama' => 'Kelurahan Sukawarna',
                'kode' => '32.73.01.1001',
            ],
            'geometry' => [
                'type' => 'Polygon',
                'coordinates' => [[
                    [107.5680, -6.8800],
                    [107.5850, -6.8800],
                    [107.5870, -6.8950],
                    [107.5700, -6.8960],
                    [107.5680, -6.8800],
                ]],
            ],
        ];

        $kelurahan = Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001'],
            [
                'parent_id' => $kecamatan->id,
                'tipe' => TipeWilayah::Kelurahan,
                'nama' => 'Sukawarna',
                'luas' => 1.48,
                'lat' => -6.887200,
                'lng' => 107.576500,
                'batas' => $geojsonBatas,
            ]
        );

        // 5. RW
        $rw1 = Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001.RW01'],
            [
                'parent_id' => $kelurahan->id,
                'tipe' => TipeWilayah::RW,
                'nama' => 'RW 01',
                'lat' => -6.884500,
                'lng' => 107.573000,
            ]
        );

        $rw2 = Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001.RW02'],
            [
                'parent_id' => $kelurahan->id,
                'tipe' => TipeWilayah::RW,
                'nama' => 'RW 02',
                'lat' => -6.887000,
                'lng' => 107.578000,
            ]
        );

        $rw3 = Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001.RW03'],
            [
                'parent_id' => $kelurahan->id,
                'tipe' => TipeWilayah::RW,
                'nama' => 'RW 03',
                'lat' => -6.890000,
                'lng' => 107.575000,
            ]
        );

        // 6. RT
        Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001.RW01.RT01'],
            [
                'parent_id' => $rw1->id,
                'tipe' => TipeWilayah::RT,
                'nama' => 'RT 01',
                'lat' => -6.884000,
                'lng' => 107.572500,
            ]
        );

        Wilayah::firstOrCreate(
            ['kode' => '32.73.01.1001.RW01.RT02'],
            [
                'parent_id' => $rw1->id,
                'tipe' => TipeWilayah::RT,
                'nama' => 'RT 02',
                'lat' => -6.884800,
                'lng' => 107.573500,
            ]
        );
    }
}
