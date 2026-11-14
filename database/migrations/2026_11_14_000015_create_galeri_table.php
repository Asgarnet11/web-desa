<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('judul', 150);
            $table->text('keterangan')->nullable();
            $table->string('tipe', 20)->default('foto'); // foto, video
            $table->string('file_url');
            $table->date('tanggal')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'tipe']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};

