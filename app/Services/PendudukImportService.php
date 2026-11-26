<?php

namespace App\Services;

use App\Enums\HubunganKeluarga;
use App\Enums\StatusKependudukan;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\Wilayah;
use App\Support\KependudukanSecurity;
use Illuminate\Support\Facades\DB;

class PendudukImportService
{
    public function __construct(
        protected DemografiSyncService $demografiSyncService
    ) {}

    /**
     * Import BIP / SIAK population CSV rows and automatically re-aggregate affected areas.
     * Expected headers: no_kk,nik,nama_lengkap,jenis_kelamin,tanggal_lahir,kode_rt,pekerjaan,pendidikan,hubungan_keluarga,status_kependudukan
     *
     * @return array{imported: int, skipped: int, errors: array<int, string>}
     */
    public function importFromCsvString(string $csvContent): array
    {
        $lines = preg_split('/\r\n|\r|\n/', trim($csvContent)) ?: [];
        if (count($lines) < 2) {
            return ['imported' => 0, 'skipped' => 0, 'errors' => ['File CSV kosong atau tidak memiliki baris data.']];
        }

        $headerLine = str_getcsv(array_shift($lines));
        $headers = array_map(fn ($h) => strtolower(trim((string) $h)), $headerLine);

        $imported = 0;
        $skipped = 0;
        $errors = [];
        $affectedWilayahIds = [];

        DB::transaction(function () use ($lines, $headers, &$imported, &$skipped, &$errors, &$affectedWilayahIds) {
            foreach ($lines as $index => $line) {
                if (trim($line) === '') {
                    continue;
                }

                $values = str_getcsv($line);
                if (count($values) !== count($headers)) {
                    $skipped++;
                    $errors[] = 'Baris '.($index + 2).': jumlah kolom tidak sesuai header.';

                    continue;
                }

                $row = array_combine($headers, array_map('trim', $values));
                $wilayah = Wilayah::where('kode', $row['kode_rt'] ?? '')->first();

                if (! $wilayah) {
                    $skipped++;
                    $errors[] = 'Baris '.($index + 2).': kode wilayah "'.($row['kode_rt'] ?? '').'" tidak ditemukan.';

                    continue;
                }

                $nik = $row['nik'] ?? '';
                $noKk = $row['no_kk'] ?? '';
                if ($nik === '' || $noKk === '') {
                    $skipped++;
                    $errors[] = 'Baris '.($index + 2).': NIK atau No. KK kosong.';

                    continue;
                }

                $kkHash = KependudukanSecurity::hashIdentifier($noKk);
                $kk = KartuKeluarga::firstOrCreate(
                    ['no_kk_hash' => $kkHash],
                    [
                        'wilayah_id' => $wilayah->id,
                        'no_kk' => $noKk,
                        'kepala_keluarga_nama' => $row['nama_lengkap'] ?? 'Kepala Keluarga',
                        'alamat_ringkas' => $wilayah->breadcrumb_nama,
                        'status_kk' => 'aktif',
                    ]
                );

                $nikHash = KependudukanSecurity::hashIdentifier($nik);
                Penduduk::updateOrCreate(
                    ['nik_hash' => $nikHash],
                    [
                        'wilayah_id' => $wilayah->id,
                        'kartu_keluarga_id' => $kk->id,
                        'nik' => $nik,
                        'nama_lengkap' => $row['nama_lengkap'] ?: 'Warga Sukawarna',
                        'jenis_kelamin' => in_array(strtoupper($row['jenis_kelamin'] ?? 'L'), ['L', 'P'], true) ? strtoupper($row['jenis_kelamin']) : 'L',
                        'tanggal_lahir' => $row['tanggal_lahir'] ?: '1990-01-01',
                        'pekerjaan' => $row['pekerjaan'] ?? 'Karyawan Swasta',
                        'pendidikan' => $row['pendidikan'] ?? 'SMA/SMK',
                        'hubungan_keluarga' => HubunganKeluarga::tryFrom($row['hubungan_keluarga'] ?? 'kepala_keluarga') ?? HubunganKeluarga::KepalaKeluarga,
                        'status_kependudukan' => StatusKependudukan::tryFrom($row['status_kependudukan'] ?? 'tetap') ?? StatusKependudukan::Tetap,
                        'status_hidup' => 'hidup',
                        'tanggal_terdaftar' => now()->toDateString(),
                    ]
                );

                $imported++;
                $affectedWilayahIds[$wilayah->id] = $wilayah->id;
            }
        });

        foreach ($affectedWilayahIds as $wId) {
            $this->demografiSyncService->syncWilayahAndAncestors($wId);
        }

        return [
            'imported' => $imported,
            'skipped' => $skipped,
            'errors' => $errors,
        ];
    }
}
