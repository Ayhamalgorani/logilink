<?php

use App\Models\Service;
use App\Models\User;
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
        // Schema::create('workers', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Service::class);
        //     $table->foreignIdFor(User::class);
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->date('birth_date');
        //     $table->string('gender');
        //     $table->string('phone_number')->unique();
        //     $table->string('location');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('workers');

    }
};