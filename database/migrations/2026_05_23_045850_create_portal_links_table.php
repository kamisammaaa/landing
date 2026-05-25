<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portal_links', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // e.g., "E-Learning", "Sistem PKL"
            $table->string('url')->unique();
            $table->string('icon')->nullable(); // icon class atau path SVG
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['active', 'maintenance', 'offline'])->default('active');
            $table->integer('urutan')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->unsignedBigInteger('click_count')->default(0);
            $table->timestamps();

            $table->index(['status', 'is_visible', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portal_links');
    }
};