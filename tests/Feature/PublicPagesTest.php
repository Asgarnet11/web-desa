<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Wilayah;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get(route('landing'));

        $response->assertStatus(200);
        $response->assertSee('Kelurahan Sukawarna');
        $response->assertSee('Harmoni Warga');
    }

    public function test_peta_page_renders_successfully(): void
    {
        $response = $this->get(route('peta.index'));

        $response->assertStatus(200);
        $response->assertSee('Peta Fasilitas');
    }

    public function test_layanan_page_renders_successfully(): void
    {
        $response = $this->get(route('layanan.index'));

        $response->assertStatus(200);
        $response->assertSee('Layanan Administrasi');
    }

    public function test_umkm_page_renders_successfully(): void
    {
        $response = $this->get(route('umkm.index'));

        $response->assertStatus(200);
        $response->assertSee('Direktori UMKM');
    }

    public function test_berita_index_and_detail_renders_successfully(): void
    {
        $response = $this->get(route('berita.index'));
        $response->assertStatus(200);

        $berita = Berita::first();
        if ($berita) {
            $showResponse = $this->get(route('berita.show', $berita->slug));
            $showResponse->assertStatus(200);
            $showResponse->assertSee($berita->judul);
        }
    }

    public function test_pengaduan_can_be_submitted_and_tracked(): void
    {
        $sukawarna = Wilayah::where('kode', '32.73.01.1001')->first();

        $response = $this->post(route('pengaduan.store'), [
            'wilayah_id' => $sukawarna->id,
            'nama_pelapor' => 'Warga Pengadu',
            'telepon_pelapor' => '081299988877',
            'kategori' => 'Infrastruktur',
            'judul' => 'Lampu PJU Padam di RW 01',
            'isi' => 'Lampu jalan penerangan utama di gang 2 padam sejak dua hari lalu.',
            'lokasi' => 'RW 01 RT 02',
        ]);

        $response->assertRedirect(route('pengaduan.index'));
        $this->assertDatabaseHas('pengaduan', [
            'nama_pelapor' => 'Warga Pengadu',
            'judul' => 'Lampu PJU Padam di RW 01',
        ]);
    }
}

