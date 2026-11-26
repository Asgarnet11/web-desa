<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('kartu_keluarga_id')->nullable()->constrained('kartu_keluarga')->nullOnDelete();
            $table->text('nik');
            $table->string('nik_hash', 64)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('jenis_kelamin', 5);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir');
            $table->string('golongan_darah', 5)->nullable();
            $table->string('agama', 30)->nullable();
            $table->string('status_perkawinan', 30)->nullable();
            $table->string('pekerjaan', 80)->nullable();
            $table->string('pendidikan', 80)->nullable();
            $table->string('hubungan_keluarga', 30)->default('anak');
            $table->string('status_kependudukan', 30)->default('tetap');
            $table->string('status_hidup', 30)->default('hidup');
            $table->date('tanggal_terdaftar')->nullable();
            $table->date('tanggal_nonaktif')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'status_kependudukan', 'jenis_kelamin'], 'penduduk_wilayah_status_jk_idx');
            $table->index(['kartu_keluarga_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
