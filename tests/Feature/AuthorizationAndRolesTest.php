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

    public function test_login_page_renders_with_official_identity_and_demo_switchers(): void
    {
        $response = $this->get('/admin/login');

        $response->assertSuccessful();
        $response->assertSee('Portal Aparatur Kelurahan');
        $response->assertSee('lurah@kelurahan.test');
        $response->assertSee('operator@kelurahan.test');
        $response->assertSee('admin@kelurahan.test');
        $response->assertSee('superadmin@kelurahan.test');
        $response->assertSee('Kepatuhan UU PDP &amp; Audit Aktif', false);
    }

    public function test_pimpinan_role_can_access_dashboard(): void
    {
        $pimpinan = User::where('email', 'lurah@kelurahan.test')->first();
        $response = $this->actingAs($pimpinan)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('Ringkasan Eksekutif Wilayah');
        $response->assertSee('Pimpinan Wilayah / Lurah');
        $response->assertSee('Ruang Kendali Eksekutif');
        $response->assertSee('Pusat Komando &amp; Disposisi Eksekutif', false);
    }

    public function test_operator_role_can_access_dashboard(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $response = $this->actingAs($operator)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('Meja Kerja Pelayanan Warga');
        $response->assertSee('Operator Pelayanan &amp; Loket', false);
        $response->assertSee('Meja Kerja Operasional');
        $response->assertSee('Meja Kerja &amp; Navigasi Operasional Loket', false);
    }

    public function test_admin_wilayah_role_can_access_dashboard(): void
    {
        $adminWilayah = User::where('email', 'admin@kelurahan.test')->first();
        $response = $this->actingAs($adminWilayah)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('Supervisi Kecamatan Sukasari');
        $response->assertSee('Admin Wilayah / Kecamatan Sukasari');
        $response->assertSee('Supervisi Kewilayahan');
        $response->assertSee('Supervisi Wilayah &amp; Koordinasi Kewilayahan', false);
    }

    public function test_superadmin_role_can_access_dashboard(): void
    {
        $superAdmin = User::where('email', 'superadmin@kelurahan.test')->first();
        $response = $this->actingAs($superAdmin)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('Tata Kelola &amp; Keamanan Sistem', false);
        $response->assertSee('Super Administrator Sistem');
        $response->assertSee('Audit Trail &amp; Rekaman Log Aktivitas', false);
        $response->assertSee('Pusat Tata Kelola Sistem &amp; Keamanan Data', false);
    }
}
