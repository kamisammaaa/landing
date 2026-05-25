<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            // Tambah kolom kurikulum_unggulan sebagai JSON (untuk array)
            $table->json('kurikulum_unggulan')->nullable()->after('prospek_kerja');
        });
    }

    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropColumn('kurikulum_unggulan');
        });
    }
};