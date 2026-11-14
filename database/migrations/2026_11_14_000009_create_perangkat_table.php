<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->string('jabatan', 100); // Lurah, Sekretaris, Kasi Pemerintahan, Kasi Pembangunan, dll.
            $table->string('nip', 50)->nullable();
            $table->string('foto')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();

            $table->index(['wilayah_id', 'urutan', 'status_aktif']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perangkat');
    }
};

