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
        $sukawarna = Wilayah::where('kode', '32.73.01.1001')->first();

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

        // 2. Admin Wilayah (Kecamatan Sukasari)
        $sukasari = Wilayah::where('kode', '32.73.01')->first();
        User::updateOrCreate(
            ['email' => 'admin@kelurahan.test'],
            [
                'name' => 'Admin Wilayah Sukasari',
                'password' => Hash::make('password'),
                'peran' => PeranUser::AdminWilayah,
                'wilayah_id' => $sukasari?->id,
                'status_aktif' => true,
            ]
        );

        // 3. Operator Kelurahan Sukawarna
        User::updateOrCreate(
            ['email' => 'operator@kelurahan.test'],
            [
                'name' => 'Operator Sukawarna',
                'password' => Hash::make('password'),
                'peran' => PeranUser::Operator,
                'wilayah_id' => $sukawarna?->id,
                'status_aktif' => true,
            ]
        );

        // 4. Pimpinan (Lurah Sukawarna)
        User::updateOrCreate(
            ['email' => 'lurah@kelurahan.test'],
            [
                'name' => 'Drs. H. Rahmat Hidayat, M.Si (Lurah)',
                'password' => Hash::make('password'),
                'peran' => PeranUser::Pimpinan,
                'wilayah_id' => $sukawarna?->id,
                'status_aktif' => true,
            ]
        );
    }
}
