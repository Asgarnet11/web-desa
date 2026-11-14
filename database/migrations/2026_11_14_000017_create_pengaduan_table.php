<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nomor_tiket', 50)->unique();
            $table->string('nama_pelapor', 100);
            $table->string('email_pelapor', 100)->nullable();
            $table->string('telepon_pelapor', 30);
            $table->string('kategori', 50)->default('Infrastruktur'); // Infrastruktur, Kebersihan, Ketertiban, Pelayanan, Sosial
            $table->string('judul', 200);
            $table->text('isi');
            $table->string('foto')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status', 30)->default('menunggu'); // menunggu, diproses, selesai, ditolak
            $table->text('tanggapan')->nullable();
            $table->foreignId('ditanggapi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('ditanggapi_pada')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};

