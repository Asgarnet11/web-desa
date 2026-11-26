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

        // 5. 7 RW dengan polygon batas tematik agar peta choropleth terhubung riil
        $rwDefinitions = [
            ['num' => '01', 'lat' => -6.8830, 'lng' => 107.5720, 'box' => [107.5690, -6.8810, 107.5750, -6.8855]],
            ['num' => '02', 'lat' => -6.8830, 'lng' => 107.5785, 'box' => [107.5750, -6.8810, 107.5820, -6.8855]],
            ['num' => '03', 'lat' => -6.8875, 'lng' => 107.5720, 'box' => [107.5690, -6.8855, 107.5750, -6.8900]],
            ['num' => '04', 'lat' => -6.8875, 'lng' => 107.5785, 'box' => [107.5750, -6.8855, 107.5820, -6.8900]],
            ['num' => '05', 'lat' => -6.8920, 'lng' => 107.5725, 'box' => [107.5695, -6.8900, 107.5755, -6.8945]],
            ['num' => '06', 'lat' => -6.8920, 'lng' => 107.5785, 'box' => [107.5755, -6.8900, 107.5825, -6.8945]],
            ['num' => '07', 'lat' => -6.8875, 'lng' => 107.5840, 'box' => [107.5820, -6.8815, 107.5860, -6.8935]],
        ];

        foreach ($rwDefinitions as $def) {
            [$minLng, $maxLat, $maxLng, $minLat] = $def['box'];
            $rwPolygon = [
                'type' => 'Feature',
                'properties' => [
                    'nama' => "RW {$def['num']}",
                    'kode' => "32.73.01.1001.RW{$def['num']}",
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [$minLng, $maxLat],
                        [$maxLng, $maxLat],
                        [$maxLng, $minLat],
                        [$minLng, $minLat],
                        [$minLng, $maxLat],
                    ]],
                ],
            ];

            $rw = Wilayah::updateOrCreate(
                ['kode' => "32.73.01.1001.RW{$def['num']}"],
                [
                    'parent_id' => $kelurahan->id,
                    'tipe' => TipeWilayah::RW,
                    'nama' => "RW {$def['num']}",
                    'luas' => 0.21,
                    'lat' => $def['lat'],
                    'lng' => $def['lng'],
                    'batas' => $rwPolygon,
                ]
            );

            // 6. 2 RT per RW
            foreach (['01' => -0.0004, '02' => 0.0004] as $rtNum => $offset) {
                Wilayah::firstOrCreate(
                    ['kode' => "32.73.01.1001.RW{$def['num']}.RT{$rtNum}"],
                    [
                        'parent_id' => $rw->id,
                        'tipe' => TipeWilayah::RT,
                        'nama' => "RT {$rtNum}",
                        'lat' => $def['lat'] + $offset,
                        'lng' => $def['lng'] + $offset,
                    ]
                );
            }
        }
    }
}
