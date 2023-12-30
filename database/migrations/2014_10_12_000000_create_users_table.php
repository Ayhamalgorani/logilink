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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone_number')->unique()->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_worker')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_terms_agreed')->default(false);
            $table->string('password')->hash();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};