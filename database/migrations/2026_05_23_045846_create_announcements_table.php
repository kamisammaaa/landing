<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->enum('tipe', ['info', 'warning', 'success', 'danger'])->default('info');
            $table->boolean('is_active')->default(true);
            $table->timestamp('mulai_tampil')->nullable();
            $table->timestamp('selesai_tampil')->nullable();
            $table->string('target_url')->nullable(); // Link opsional
            $table->integer('urutan')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'mulai_tampil', 'selesai_tampil']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};