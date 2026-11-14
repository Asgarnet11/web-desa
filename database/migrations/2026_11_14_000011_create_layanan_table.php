<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nama_layanan', 150);
            $table->string('kategori', 50)->default('Kependudukan'); // Kependudukan, Perizinan, Surat Keterangan, Sosial
            $table->json('persyaratan')->nullable(); // array of requirements
            $table->text('alur_pelayanan')->nullable();
            $table->string('waktu_penyelesaian', 50)->default('1 Hari Kerja');
            $table->string('biaya', 50)->default('Gratis');
            $table->string('jam_buka', 100)->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();

            $table->index(['wilayah_id', 'is_aktif']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};

