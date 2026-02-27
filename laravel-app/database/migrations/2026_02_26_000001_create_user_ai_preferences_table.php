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
        Schema::create('user_ai_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('lifestyle', ['sedentary', 'moderate', 'active']);
            $table->enum('budget', ['limited', 'moderate', 'generous']);
            $table->enum('home_env', ['apartment', 'house', 'large_house']);
            $table->enum('activity', ['little', 'moderate', 'lots']);
            $table->enum('experience', ['first_time', 'some', 'experienced']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ai_preferences');
    }
};
