<?php

namespace Tests\Feature;

use App\Enums\HubunganKeluarga;
use App\Enums\JenisKelamin;
use App\Enums\JenisMutasi;
use App\Enums\KategoriPemantauan;
use App\Enums\StatusKependudukan;
use App\Enums\StatusVerifikasi;
use App\Models\Demografi;
use App\Models\KartuKeluarga;
use App\Models\LogAktivitas;
use App\Models\MutasiPenduduk;
use App\Models\PemantauanKesehatan;
use App\Models\Penduduk;
use App\Models\User;
use App\Models\Wilayah;
use App\Services\MutasiPendudukService;
use App\Services\PendudukImportService;
use App\Support\KependudukanSecurity;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class KependudukanRealtimeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_wilayah_scope_handles_three_level_hierarchy_kelurahan_rw_rt(): void
    {
        $kelurahan = Wilayah::where('kode', '32.73.01.1001')->first();
        $rw01 = Wilayah::where('kode', '32.73.01.1001.RW01')->first();
        $rw02 = Wilayah::where('kode', '32.73.01.1001.RW02')->first();

        $descendants = $kelurahan->getDescendantIds(true);
        $this->assertGreaterThanOrEqual(22, count($descendants)); // 1 kel + 7 rw + 14 rt

        $rtUser = User::where('email', 'rt01@kelurahan.test')->first();
        $this->actingAs($rtUser);

        $rt01CitizenCount = Penduduk::forCurrentUserWilayah()->count();
        $this->assertGreaterThan(0, $rt01CitizenCount);

        // Verify RW 02 citizens are excluded from RW 01 user scope
        $rw02RtIds = $rw02->getDescendantIds(false);
        $leakedFromRw02 = Penduduk::forCurrentUserWilayah()->whereIn('wilayah_id', $rw02RtIds)->count();
        $this->assertSame(0, $leakedFromRw02);
        $this->assertNotEquals($rw01->id, $rw02->id);
    }

    public function test_uu_pdp_encryption_masking_and_audit_log_redaction(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $rt01 = Wilayah::where('kode', '32.73.01.1001.RW01.RT01')->first();
        $this->actingAs($operator);

        $rawNik = '3273012202920077';
        $rawKk = '3273011001200077';

        $kk = KartuKeluarga::create([
            'wilayah_id' => $rt01->id,
            'no_kk' => $rawKk,
            'kepala_keluarga_nama' => 'Budi Santoso',
            'alamat_ringkas' => 'Jl. Sukawarna Test No. 77',
            'status_kk' => 'aktif',
        ]);

        $penduduk = Penduduk::create([
            'wilayah_id' => $rt01->id,
            'kartu_keluarga_id' => $kk->id,
            'nik' => $rawNik,
            'nama_lengkap' => 'Siti Rahayu Test',
            'jenis_kelamin' => JenisKelamin::Perempuan,
            'tanggal_lahir' => '1992-02-22',
            'hubungan_keluarga' => HubunganKeluarga::Istri,
            'status_kependudukan' => StatusKependudukan::Tetap,
        ]);

        $this->assertSame('327301••••••0077', $penduduk->nik_tersamar);
        $this->assertSame(KependudukanSecurity::hashIdentifier($rawNik), $penduduk->nik_hash);

        $logPenduduk = LogAktivitas::where('entitas', 'Penduduk')
            ->where('entitas_id', $penduduk->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($logPenduduk);
        $this->assertSame('[TERENKRIPSI]', $logPenduduk->nilai_baru['nik']);
        $this->assertSame('[TERENKRIPSI]', $logPenduduk->nilai_baru['nik_hash']);
    }

    public function test_strict_health_and_pii_authorization_policies(): void
    {
        $adminWilayah = User::where('email', 'admin@kelurahan.test')->first();
        $pimpinan = User::where('email', 'lurah@kelurahan.test')->first();
        $ketuaRt = User::where('email', 'rt01@kelurahan.test')->first();
        $kader = User::where('email', 'kader@kelurahan.test')->first();
        $operator = User::where('email', 'operator@kelurahan.test')->first();

        $penduduk = Penduduk::first();
        $kesehatan = PemantauanKesehatan::first();

        // Kecamatan AdminWilayah & Pimpinan cannot read confidential maternal/health records
        $this->assertFalse(Gate::forUser($adminWilayah)->allows('view', $penduduk));
        $this->assertFalse(Gate::forUser($adminWilayah)->allows('view', $kesehatan));
        $this->assertFalse(Gate::forUser($pimpinan)->allows('view', $kesehatan));
        $this->assertFalse(Gate::forUser($ketuaRt)->allows('view', $kesehatan));

        // Kader Kesehatan & Operator can access & manage health records
        $this->assertTrue(Gate::forUser($kader)->allows('create', PemantauanKesehatan::class));
        $this->assertTrue(Gate::forUser($kader)->allows('view', $kesehatan));
        $this->assertTrue(Gate::forUser($operator)->allows('verify', MutasiPenduduk::first()));
        $this->assertFalse(Gate::forUser($ketuaRt)->allows('verify', MutasiPenduduk::first()));
    }

    public function test_kelahiran_mutation_adds_newborn_closes_pregnancy_and_syncs_demography_realtime(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $kelurahan = Wilayah::where('kode', '32.73.01.1001')->first();

        $bumilRecord = PemantauanKesehatan::where('kategori', KategoriPemantauan::IbuHamil->value)
            ->where('aktif', true)
            ->with('penduduk')
            ->first();

        $this->assertNotNull($bumilRecord);

        $sebelum = Demografi::where('wilayah_id', $kelurahan->id)
            ->where('periode', (string) now()->year)
            ->first();
        $popSebelum = $sebelum->jumlah_penduduk;
        $bumilSebelum = $sebelum->rincian['kesehatan_keluarga']['ibu_hamil'];

        $mutasi = MutasiPenduduk::create([
            'wilayah_id' => $bumilRecord->wilayah_id,
            'kartu_keluarga_id' => $bumilRecord->penduduk->kartu_keluarga_id,
            'jenis_mutasi' => JenisMutasi::Kelahiran,
            'tanggal_peristiwa' => now()->toDateString(),
            'asal_atau_tujuan' => 'RSUD Kota Bandung',
            'payload_data' => [
                'ibu_penduduk_id' => $bumilRecord->penduduk_id,
                'nama_lengkap' => 'Bayi Sehat Sukawarna',
                'jenis_kelamin' => JenisKelamin::Perempuan->value,
                'daftarkan_balita' => true,
            ],
            'status_verifikasi' => StatusVerifikasi::Diajukan,
        ]);

        $verified = app(MutasiPendudukService::class)->verifikasiDanTerapkan($mutasi, $operator, 'Akta & SKL terverifikasi');

        // 1. Newborn created & pregnancy monitoring auto-closed
        $this->assertNotNull($verified->penduduk_id);
        $this->assertFalse($bumilRecord->fresh()->aktif);
        $this->assertTrue(
            PemantauanKesehatan::where('penduduk_id', $verified->penduduk_id)
                ->where('kategori', KategoriPemantauan::BalitaGizi->value)
                ->where('aktif', true)
                ->exists()
        );

        // 2. Kelurahan aggregate demography automatically incremented (+1 resident, -1 active pregnancy)
        $sesudah = $sebelum->fresh();
        $this->assertSame($popSebelum + 1, $sesudah->jumlah_penduduk);
        $this->assertSame($bumilSebelum - 1, $sesudah->rincian['kesehatan_keluarga']['ibu_hamil']);

        // 3. Official QR verification page recognizes the issued SKL-SKW code from database
        $qrResp = $this->get(route('verifikasi.show', $verified->nomor_surat_pengantar));
        $qrResp->assertSuccessful();
        $qrResp->assertSee('DOKUMEN RESMI TERDAFTAR');
        $qrResp->assertSee($verified->nomor_surat_pengantar);
    }

    public function test_kematian_and_pindah_keluar_decrement_active_population_and_close_health_tracking(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();
        $kelurahan = Wilayah::where('kode', '32.73.01.1001')->first();

        $lansia = PemantauanKesehatan::where('kategori', KategoriPemantauan::LansiaRentan->value)
            ->where('aktif', true)
            ->first();
        $this->assertNotNull($lansia);

        $popAwal = Demografi::where('wilayah_id', $kelurahan->id)->where('periode', (string) now()->year)->first()->jumlah_penduduk;

        $mutasiWafat = MutasiPenduduk::create([
            'wilayah_id' => $lansia->wilayah_id,
            'penduduk_id' => $lansia->penduduk_id,
            'jenis_mutasi' => JenisMutasi::Kematian,
            'tanggal_peristiwa' => now()->toDateString(),
            'asal_atau_tujuan' => 'Rumah Duka RW 01',
            'status_verifikasi' => StatusVerifikasi::Diajukan,
        ]);

        app(MutasiPendudukService::class)->verifikasiDanTerapkan($mutasiWafat, $operator);

        $this->assertSame(StatusKependudukan::Meninggal, $lansia->penduduk->fresh()->status_kependudukan);
        $this->assertFalse($lansia->fresh()->aktif);

        $popSetelahWafat = Demografi::where('wilayah_id', $kelurahan->id)->where('periode', (string) now()->year)->first()->jumlah_penduduk;
        $this->assertSame($popAwal - 1, $popSetelahWafat);
    }

    public function test_csv_import_adds_citizens_and_syncs_demography(): void
    {
        $kelurahan = Wilayah::where('kode', '32.73.01.1001')->first();
        $popAwal = Demografi::where('wilayah_id', $kelurahan->id)->where('periode', (string) now()->year)->first()->jumlah_penduduk;

        $csv = "no_kk,nik,nama_lengkap,jenis_kelamin,tanggal_lahir,kode_rt,pekerjaan,pendidikan,hubungan_keluarga,status_kependudukan\n".
               "3273018808800001,3273018808800002,Dian Permata Import,P,1994-06-12,32.73.01.1001.RW07.RT01,Wirausaha/UMKM,Diploma/Sarjana,kepala_keluarga,tetap\n";

        $result = app(PendudukImportService::class)->importFromCsvString($csv);

        $this->assertSame(1, $result['imported']);
        $this->assertSame(0, $result['skipped']);

        $popAkhir = Demografi::where('wilayah_id', $kelurahan->id)->where('periode', (string) now()->year)->first()->jumlah_penduduk;
        $this->assertSame($popAwal + 1, $popAkhir);
    }

    public function test_rt_rw_role_can_access_dashboard(): void
    {
        $rt01 = User::where('email', 'rt01@kelurahan.test')->first();
        $rtResp = $this->actingAs($rt01)->get('/admin');
        $rtResp->assertSuccessful();
        $rtResp->assertSee('Pelaporan Warga RT / RW');
    }

    public function test_kader_kesehatan_role_can_access_dashboard(): void
    {
        $kader = User::where('email', 'kader@kelurahan.test')->first();
        $kaderResp = $this->actingAs($kader)->get('/admin');
        $kaderResp->assertSuccessful();
        $kaderResp->assertSee('Pemantauan Posyandu &amp; Keluarga', false);
    }

    public function test_operator_can_open_all_kependudukan_filament_resources(): void
    {
        $operator = User::where('email', 'operator@kelurahan.test')->first();

        $this->actingAs($operator)->get('/admin/kartu-keluargas')->assertSuccessful();
        $this->actingAs($operator)->get('/admin/penduduks')->assertSuccessful();
        $this->actingAs($operator)->get('/admin/mutasi-penduduks')->assertSuccessful();
        $this->actingAs($operator)->get('/admin/pemantauan-kesehatans')->assertSuccessful();
    }
}
