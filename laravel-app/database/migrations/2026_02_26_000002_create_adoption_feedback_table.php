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
        Schema::create('adoption_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adoption_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('cat_id')->constrained()->onDelete('cascade');
            $table->integer('success_score')->comment('0-100: Satisfaction with match'); // 0-100
            $table->text('notes')->nullable();
            $table->json('user_prefs')->nullable()->comment('User preferences at time of adoption');
            $table->json('cat_attributes')->nullable()->comment('Cat attributes at time of adoption');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_feedback');
    }
};
