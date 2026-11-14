<?php

namespace App\Actions;

use App\Enums\StatusPengaduan;
use App\Models\Pengaduan;
use App\Models\Wilayah;
use Illuminate\Support\Str;

class BuatPengaduanAction
{
    public function __invoke(array $data): Pengaduan
    {
        $nomorTiket = 'PGD-'.date('Ym').'-'.strtoupper(Str::random(5));

        $wilayahId = $data['wilayah_id'] ?? null;
        if (! $wilayahId) {
            $wilayahId = Wilayah::where('tipe', 'kelurahan')->first()?->id ?? Wilayah::first()->id;
        }

        return Pengaduan::create([
            'wilayah_id' => $wilayahId,
            'nomor_tiket' => $nomorTiket,
            'nama_pelapor' => $data['nama_pelapor'],
            'email_pelapor' => $data['email_pelapor'] ?? null,
            'telepon_pelapor' => $data['telepon_pelapor'],
            'kategori' => $data['kategori'] ?? 'Pelayanan',
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'foto' => $data['foto'] ?? null,
            'lokasi' => $data['lokasi'] ?? null,
            'status' => StatusPengaduan::Menunggu,
        ]);
    }
}

