<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 100)->unique();
            $table->string('ikon', 50)->default('heroicon-o-map-pin');
            $table->string('warna', 30)->default('#2D6A4F');
            $table->string('kelompok', 50); // Pendidikan, Kesehatan, Ibadah, Pemerintahan, Ekonomi, Sosial, Olahraga
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_fasilitas');
    }
};
