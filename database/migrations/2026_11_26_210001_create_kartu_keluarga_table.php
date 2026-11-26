<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->text('no_kk');
            $table->string('no_kk_hash', 64)->unique();
            $table->string('kepala_keluarga_nama', 150);
            $table->string('alamat_ringkas', 255);
            $table->string('status_kk', 30)->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'status_kk']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_keluarga');
    }
};
