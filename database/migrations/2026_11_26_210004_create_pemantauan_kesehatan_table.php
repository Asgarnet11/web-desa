<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemantauan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();
            $table->string('kategori', 30);
            $table->string('status_risiko', 30)->default('normal');
            $table->unsignedSmallInteger('usia_kehamilan_minggu')->nullable();
            $table->date('hari_perkiraan_lahir')->nullable();
            $table->decimal('berat_badan_kg', 5, 2)->nullable();
            $table->decimal('tinggi_badan_cm', 5, 2)->nullable();
            $table->boolean('aktif')->default(true);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->text('catatan_tindakan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['wilayah_id', 'kategori', 'aktif'], 'kesehatan_wilayah_kategori_aktif_idx');
            $table->index(['penduduk_id', 'aktif']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemantauan_kesehatan');
    }
};
