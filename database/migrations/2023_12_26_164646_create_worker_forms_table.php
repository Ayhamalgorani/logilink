<?php

use App\Models\Service;
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
        Schema::create('worker_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class);
            $table->string('name');
            $table->string('email');
            $table->string('location');
            $table->string('phone_number');
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('nationality', ['jordaninan', 'egyptian', 'syrian']);
            $table->boolean('is_terms_agreed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_forms');
    }
};
