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
            ['kode' => '74'],
            [
                'tipe' => TipeWilayah::Provinsi,
                'nama' => 'Sulawesi Tenggara',
                'lat' => -3.998500,
                'lng' => 122.512900,
            ]
        );

        // 2. Kabupaten Konawe Selatan
        $kabupaten = Wilayah::firstOrCreate(
            ['kode' => '74.05'],
            [
                'parent_id' => $provinsi->id,
                'tipe' => TipeWilayah::KabupatenKota,
                'nama' => 'Kabupaten Konawe Selatan',
                'lat' => -4.242000,
                'lng' => 122.460000,
                'luas' => 4237.74,
            ]
        );

        // 3. Kecamatan Konda
        $kecamatan = Wilayah::firstOrCreate(
            ['kode' => '74.05.07'],
            [
                'parent_id' => $kabupaten->id,
                'tipe' => TipeWilayah::Kecamatan,
                'nama' => 'Konda',
                'lat' => -4.124400,
                'lng' => 122.440300,
                'luas' => 132.50,
            ]
        );

        // 4. Kelurahan Konda (4°07′28″S 122°26′25″E)
        $geojsonBatas = [
            'type' => 'Feature',
            'properties' => [
                'nama' => 'Kelurahan Konda',
                'kode' => '74.05.07.1001',
            ],
            'geometry' => [
                'type' => 'Polygon',
                'coordinates' => [[
                    [122.4300, -4.1150],
                    [122.4510, -4.1150],
                    [122.4510, -4.1340],
                    [122.4300, -4.1340],
                    [122.4300, -4.1150],
                ]],
            ],
        ];

        $kelurahan = Wilayah::firstOrCreate(
            ['kode' => '74.05.07.1001'],
            [
                'parent_id' => $kecamatan->id,
                'tipe' => TipeWilayah::Kelurahan,
                'nama' => 'Konda',
                'luas' => 4.65,
                'lat' => -4.124444,
                'lng' => 122.440278,
                'batas' => $geojsonBatas,
            ]
        );

        // 5. 7 RW dengan polygon batas tematik agar peta choropleth terhubung riil
        $rwDefinitions = [
            ['num' => '01', 'lat' => -4.1190, 'lng' => 122.4355, 'box' => [122.4315, -4.1165, 122.4395, -4.1215]],
            ['num' => '02', 'lat' => -4.1190, 'lng' => 122.4435, 'box' => [122.4395, -4.1165, 122.4475, -4.1215]],
            ['num' => '03', 'lat' => -4.1242, 'lng' => 122.4355, 'box' => [122.4315, -4.1215, 122.4395, -4.1270]],
            ['num' => '04', 'lat' => -4.1242, 'lng' => 122.4435, 'box' => [122.4395, -4.1215, 122.4475, -4.1270]],
            ['num' => '05', 'lat' => -4.1295, 'lng' => 122.4355, 'box' => [122.4315, -4.1270, 122.4395, -4.1325]],
            ['num' => '06', 'lat' => -4.1295, 'lng' => 122.4435, 'box' => [122.4395, -4.1270, 122.4475, -4.1325]],
            ['num' => '07', 'lat' => -4.1242, 'lng' => 122.4488, 'box' => [122.4475, -4.1170, 122.4502, -4.1320]],
        ];

        foreach ($rwDefinitions as $def) {
            [$minLng, $maxLat, $maxLng, $minLat] = $def['box'];
            $rwPolygon = [
                'type' => 'Feature',
                'properties' => [
                    'nama' => "RW {$def['num']}",
                    'kode' => "74.05.07.1001.RW{$def['num']}",
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
                ['kode' => "74.05.07.1001.RW{$def['num']}"],
                [
                    'parent_id' => $kelurahan->id,
                    'tipe' => TipeWilayah::RW,
                    'nama' => "RW {$def['num']}",
                    'luas' => 0.66,
                    'lat' => $def['lat'],
                    'lng' => $def['lng'],
                    'batas' => $rwPolygon,
                ]
            );

            // 6. 2 RT per RW
            foreach (['01' => -0.0004, '02' => 0.0004] as $rtNum => $offset) {
                Wilayah::firstOrCreate(
                    ['kode' => "74.05.07.1001.RW{$def['num']}.RT{$rtNum}"],
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
