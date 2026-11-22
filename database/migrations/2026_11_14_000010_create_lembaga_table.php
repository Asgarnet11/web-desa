<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nama_lembaga', 150); // LPM, PKK, Karang Taruna, Posyandu, RT, RW
            $table->string('ketua', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('jumlah_anggota')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga');
    }
};
