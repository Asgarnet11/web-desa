<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('infrastruktur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('jenis', 50); // jalan, jembatan, irigasi, drainase, air_bersih, listrik, internet
            $table->string('nama', 150);
            $table->string('volume_kapasitas', 100)->nullable();
            $table->string('kondisi', 30)->default('baik'); // baik, rusak_ringan, rusak_sedang, rusak_berat
            $table->json('geometri')->nullable(); // GeoJSON LineString/Point/Polygon
            $table->string('periode', 20)->default('2026');
            $table->string('status_verifikasi', 30)->default('draf');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'jenis', 'kondisi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infrastruktur');
    }
};

