<?php

use App\Models\User;
use App\Models\WorkerForm;
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
        // Schema::create('worker_files', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(WorkerForm::class);
        //     $table->string('title');
        //     $table->text('file');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('worker_files');
    }
};