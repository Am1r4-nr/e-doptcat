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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('matric')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('program')->nullable();
            $table->string('availability')->nullable();
            $table->string('avail_time')->nullable();
            $table->enum('status', ['PENDING', 'INTERVIEWING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->json('skills')->nullable();
            $table->text('bio')->nullable();
            $table->text('experience')->nullable();
            $table->string('location')->nullable();
            $table->date('applied_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
