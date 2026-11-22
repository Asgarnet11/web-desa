<?php

namespace Tests\Feature;

use App\Models\Fasilitas;
use App\Models\User;
use App\Models\Wilayah;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AuthorizationAndRolesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_superadmin_has_full_access(): void
    {
        $superAdmin = User::where('email', 'superadmin@kelurahan.test')->first();
        $fasilitas = Fasilitas::first();

        $this->assertTrue($superAdmin->isSuperAdmin());
        $this->assertTrue(Gate::forUser($superAdmin)->allows('update', $fasilitas));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('delete', $fasilitas));
    }

    public function test_pimpinan_has_read_only_access(): void
    {
        $pimpinan = User::where('email', 'lurah@kelurahan.test')->first();
        $fasilitas = Fasilitas::first();

        $this->assertTrue($pimpinan->isPimpinan());
        $this->assertTrue(Gate::forUser($pimpinan)->allows('view', $fasilitas));
        $this->assertFalse(Gate::forUser($pimpinan)->allows('update', $fasilitas));
        $this->assertFalse(Gate::forUser($pimpinan)->allows('delete', $fasilitas));
    }

    public function test_operator_can_only_manage_own_wilayah(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $fasilitasSukawarna = Fasilitas::where('wilayah_id', $operator->wilayah_id)->first();

        // Create another wilayah and facility
        $wilayahLain = Wilayah::create([
            'kode' => '32.73.01.9999',
            'tipe' => 'kelurahan',
            'nama' => 'Kelurahan Lain',
        ]);
        $fasilitasLain = Fasilitas::create([
            'wilayah_id' => $wilayahLain->id,
            'kategori_id' => $fasilitasSukawarna->kategori_id,
            'nama' => 'Fasilitas Wilayah Lain',
            'lat' => -6.9000,
            'lng' => 107.6000,
            'kondisi' => 'baik',
            'status_verifikasi' => 'terverifikasi',
        ]);

        $this->assertTrue(Gate::forUser($operator)->allows('update', $fasilitasSukawarna));
        $this->assertFalse(Gate::forUser($operator)->allows('update', $fasilitasLain));
    }

    public function test_authenticated_user_can_access_filament_dashboard(): void
    {
        $superAdmin = User::where('email', 'superadmin@kelurahan.test')->first();

        $response = $this->actingAs($superAdmin)->get('/admin');

        $response->assertSuccessful();
    }
}
