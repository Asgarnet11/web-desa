<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('judul', 255);
            $table->text('isi');
            $table->string('berkas')->nullable();
            $table->string('status', 30)->default('terbit');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['wilayah_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
