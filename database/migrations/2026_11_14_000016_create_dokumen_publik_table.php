<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_publik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('judul', 200);
            $table->string('kategori', 50)->default('Laporan'); // Peraturan, SOP, Laporan, Formulir
            $table->string('file_path');
            $table->string('ukuran_file', 30)->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->timestamps();

            $table->index(['wilayah_id', 'kategori']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_publik');
    }
};
