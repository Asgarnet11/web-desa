<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->unique()->constrained('wilayah')->cascadeOnDelete();
            $table->string('slogan', 255)->nullable();
            $table->longText('sejarah')->nullable();
            $table->string('tahun_terbentuk', 10)->nullable();
            $table->text('makna_lambang')->nullable();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable();
            $table->string('motto_pelayanan', 255)->nullable();
            $table->string('foto_kantor')->nullable();
            $table->string('foto_peta_wilayah')->nullable();
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();
            $table->string('kontak_telepon', 30)->nullable();
            $table->string('kontak_whatsapp', 30)->nullable();
            $table->string('kontak_email', 100)->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->text('jam_pelayanan')->nullable();
            $table->json('social_media')->nullable(); // ig, fb, yt, etc.
            $table->json('pengaturan_bagian')->nullable(); // toggle section visible & sort order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_kelurahan');
    }
};
