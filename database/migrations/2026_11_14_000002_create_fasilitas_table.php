<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_fasilitas')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->text('alamat')->nullable();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('kondisi', 30)->default('baik'); // baik, rusak_ringan, rusak_sedang, rusak_berat
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->string('status_verifikasi', 30)->default('draf'); // draf, diajukan, terverifikasi, ditolak
            $table->text('catatan_verifikasi')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->boolean('is_publik')->default(true);
            $table->timestamps();

            $table->index(['wilayah_id', 'status_verifikasi', 'is_publik']);
            $table->index(['kategori_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
