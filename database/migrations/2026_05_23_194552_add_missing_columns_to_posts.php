<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Tambah kolom JUDUL jika belum ada
            if (!Schema::hasColumn('posts', 'judul')) {
                $table->string('judul')->after('id');
            }

            // Tambah kolom SLUG jika belum ada
            if (!Schema::hasColumn('posts', 'slug')) {
                $table->string('slug')->unique()->after('judul');
            }

            // Tambah kolom KONTEN jika belum ada
            if (!Schema::hasColumn('posts', 'konten')) {
                $table->text('konten')->after('slug');
            }

            // Tambah kolom GAMBAR COVER jika belum ada
            if (!Schema::hasColumn('posts', 'gambar_cover')) {
                $table->string('gambar_cover')->nullable()->after('konten');
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['judul', 'slug', 'konten', 'gambar_cover']);
        });
    }
};