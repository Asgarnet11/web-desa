<?php

namespace Database\Seeders;

use App\Enums\PeranUser;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $konda = Wilayah::where('kode', '74.05.07.1001')->first();
        $rw01 = Wilayah::where('kode', '74.05.07.1001.RW01')->first();

        // 1. Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@kelurahan.test'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'peran' => PeranUser::SuperAdmin,
                'status_aktif' => true,
            ]
        );

        // 2. Admin Wilayah (Kecamatan Konda)
        $kecKonda = Wilayah::where('kode', '74.05.07')->first();
        User::updateOrCreate(
            ['email' => 'admin@kelurahan.test'],
            [
                'name' => 'Admin Wilayah Konda',
                'password' => Hash::make('password'),
                'peran' => PeranUser::AdminWilayah,
                'wilayah_id' => $kecKonda?->id,
                'status_aktif' => true,
            ]
        );

        // 3. Operator Kelurahan Konda
        User::updateOrCreate(
            ['email' => 'operator@kelurahan.test'],
            [
                'name' => 'Operator Kelurahan Konda',
                'password' => Hash::make('password'),
                'peran' => PeranUser::Operator,
                'wilayah_id' => $konda?->id,
                'status_aktif' => true,
            ]
        );

        // 4. Pimpinan (Lurah Konda)
        User::updateOrCreate(
            ['email' => 'lurah@kelurahan.test'],
            [
                'name' => 'H. La Ode Muhammad Nasir, S.Sos, M.Si (Lurah)',
                'password' => Hash::make('password'),
                'peran' => PeranUser::Pimpinan,
                'wilayah_id' => $konda?->id,
                'status_aktif' => true,
            ]
        );

        // 5. Ketua RT/RW (Lingkup RW 01)
        User::updateOrCreate(
            ['email' => 'rt01@kelurahan.test'],
            [
                'name' => 'H. Muhammad Yusuf, S.Sos (Ketua RW 01)',
                'password' => Hash::make('password'),
                'peran' => PeranUser::KetuaRtRw,
                'wilayah_id' => $rw01?->id,
                'status_aktif' => true,
            ]
        );

        // 6. Kader Kesehatan / Posyandu Kelurahan
        User::updateOrCreate(
            ['email' => 'kader@kelurahan.test'],
            [
                'name' => 'Wa Ode Siti Marwah, A.Md.Keb (Kader Posyandu)',
                'password' => Hash::make('password'),
                'peran' => PeranUser::KaderKesehatan,
                'wilayah_id' => $konda?->id,
                'status_aktif' => true,
            ]
        );
    }
}
