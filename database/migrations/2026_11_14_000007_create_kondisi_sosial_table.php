<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kondisi_sosial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('indikator', 100); // e.g. penerima_pkh, penerima_blt, stunting, rawan_banjir
            $table->string('nilai', 100);
            $table->string('periode', 20)->default('2026');
            $table->string('status_verifikasi', 30)->default('terverifikasi');
            $table->timestamps();

            $table->index(['wilayah_id', 'indikator', 'periode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kondisi_sosial');
    }
};
