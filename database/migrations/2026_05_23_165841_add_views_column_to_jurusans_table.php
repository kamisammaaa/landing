<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            // Tambah kolom views dengan default 0
            $table->unsignedBigInteger('views')->default(0)->after('is_active');
            
            // Optional: tambah index untuk performa query sorting by views
            $table->index('views');
        });
    }

    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropIndex(['views']); // Hapus index jika ada
            $table->dropColumn('views');
        });
    }
};