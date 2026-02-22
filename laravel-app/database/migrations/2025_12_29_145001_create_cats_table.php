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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('breed')->nullable();
            $table->string('gender')->nullable(); // Male, Female
            $table->string('age')->nullable();
            $table->string('size')->nullable(); // Small, Medium, Large
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('status')->default('Available'); // Available, Adopted, Foster
            $table->string('image')->nullable();
            $table->decimal('gps_lat', 10, 8)->nullable();
            $table->decimal('gps_lng', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
