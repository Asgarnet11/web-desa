<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi_penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('penduduk_id')->nullable()->constrained('penduduk')->nullOnDelete();
            $table->foreignId('kartu_keluarga_id')->nullable()->constrained('kartu_keluarga')->nullOnDelete();
            $table->string('jenis_mutasi', 30);
            $table->date('tanggal_peristiwa');
            $table->string('asal_atau_tujuan', 255)->nullable();
            $table->string('nomor_surat_pengantar', 80)->nullable()->unique();
            $table->text('payload_data')->nullable();
            $table->string('lampiran_bukti', 255)->nullable();
            $table->string('status_verifikasi', 30)->default('diajukan');
            $table->text('catatan_verifikasi')->nullable();
            $table->foreignId('diajukan_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->timestamp('disinkronkan_pada')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'jenis_mutasi', 'status_verifikasi'], 'mutasi_wilayah_jenis_status_idx');
            $table->index(['tanggal_peristiwa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_penduduk');
    }
};
