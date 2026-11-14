<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('potensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('jenis', 50); // pertanian, perikanan, pariwisata, kerajinan, seni_budaya
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->string('nilai_volume', 100)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('foto')->nullable();
            $table->string('periode', 20)->default('2026');
            $table->timestamps();

            $table->index(['wilayah_id', 'jenis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potensi');
    }
};

