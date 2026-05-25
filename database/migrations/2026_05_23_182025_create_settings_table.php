<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index(); // e.g., 'school_name', 'phone'
            $table->string('group')->default('general')->index(); // e.g., 'general', 'contact', 'seo'
            $table->longText('value')->nullable(); // Value bisa text panjang
            $table->string('type')->default('text'); // text, textarea, richeditor, image, file
            $table->text('description')->nullable(); // Helper text
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};