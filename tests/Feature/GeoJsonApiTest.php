<?php

namespace Tests\Feature;

use App\Models\Wilayah;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeoJsonApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_api_returns_geojson_batas_wilayah(): void
    {
        $response = $this->getJson(route('api.geojson.batas'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'type',
            'id',
            'properties' => [
                'id',
                'nama',
                'tipe',
                'kode',
            ],
            'geometry' => [
                'type',
                'coordinates',
            ],
        ]);
    }

    public function test_api_returns_geojson_fasilitas_collection(): void
    {
        $response = $this->getJson(route('api.geojson.fasilitas'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'type',
            'features' => [
                '*' => [
                    'type',
                    'id',
                    'properties' => [
                        'nama',
                        'kategori',
                        'warna',
                        'ikon',
                    ],
                    'geometry' => [
                        'type',
                        'coordinates',
                    ],
                ],
            ],
        ]);
    }

    public function test_api_returns_statistik_wilayah(): void
    {
        $sukawarna = Wilayah::where('kode', '32.73.01.1001')->first();

        $response = $this->getJson(route('api.statistik.show', $sukawarna->id));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'wilayah' => ['nama', 'tipe', 'luas'],
            'demografi' => ['total_penduduk', 'total_kk', 'laki_laki', 'perempuan'],
            'fasilitas' => ['total', 'per_kategori'],
            'infrastruktur' => ['total', 'baik', 'persentase_baik'],
        ]);
    }
}
