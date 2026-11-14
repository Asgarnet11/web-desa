<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->string('kategori', 50)->default('Kegiatan');
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('foto')->nullable();
            $table->string('status', 30)->default('draf'); // draf, terbit
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();

            $table->index(['wilayah_id', 'status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};

