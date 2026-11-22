<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('wilayah')->nullOnDelete();
            $table->string('tipe', 30); // provinsi, kabupaten_kota, kecamatan, desa, kelurahan, dusun, lingkungan, rw, rt
            $table->string('kode', 50)->unique();
            $table->string('nama', 150);
            $table->decimal('luas', 12, 2)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->json('batas')->nullable();
            $table->timestamps();

            $table->index(['tipe', 'parent_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};
