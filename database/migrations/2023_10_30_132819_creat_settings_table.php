<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('notification');
            $table->boolean('disable');
            $table->string('about_us');
            $table->string('privecy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');

    }
};
