<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nama_usaha', 150);
            $table->string('nama_pemilik', 100)->nullable();
            $table->string('kategori', 50)->default('Kuliner'); // Kuliner, Fashion, Kerajinan, Jasa, Pertanian
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak_wa', 30)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_unggulan')->default(false);
            $table->boolean('is_publik')->default(true);
            $table->timestamps();

            $table->index(['wilayah_id', 'is_unggulan', 'is_publik']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};

