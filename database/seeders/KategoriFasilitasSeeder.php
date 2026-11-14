<?php

namespace Database\Seeders;

use App\Models\KategoriFasilitas;
use Illuminate\Database\Seeder;

class KategoriFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'ikon' => 'heroicon-o-academic-cap',
                'warna' => '#219EBC',
                'kelompok' => 'Pendidikan',
            ],
            [
                'nama' => 'Kesehatan',
                'slug' => 'kesehatan',
                'ikon' => 'heroicon-o-heart',
                'warna' => '#B3361A',
                'kelompok' => 'Kesehatan',
            ],
            [
                'nama' => 'Tempat Ibadah',
                'slug' => 'tempat-ibadah',
                'ikon' => 'heroicon-o-building-library',
                'warna' => '#2D6A4F',
                'kelompok' => 'Ibadah',
            ],
            [
                'nama' => 'Pemerintahan',
                'slug' => 'pemerintahan',
                'ikon' => 'heroicon-o-building-office-2',
                'warna' => '#1B4332',
                'kelompok' => 'Pemerintahan',
            ],
            [
                'nama' => 'Ekonomi & Pasar',
                'slug' => 'ekonomi-pasar',
                'ikon' => 'heroicon-o-shopping-bag',
                'warna' => '#FFB703',
                'kelompok' => 'Ekonomi',
            ],
            [
                'nama' => 'Infrastruktur & Utilitas',
                'slug' => 'infrastruktur-utilitas',
                'ikon' => 'heroicon-o-wrench-screwdriver',
                'warna' => '#6B4226',
                'kelompok' => 'Infrastruktur',
            ],
            [
                'nama' => 'Sosial & Olahraga',
                'slug' => 'sosial-olahraga',
                'ikon' => 'heroicon-o-user-group',
                'warna' => '#52B788',
                'kelompok' => 'Sosial',
            ],
        ];

        foreach ($kategori as $item) {
            KategoriFasilitas::firstOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
