<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('reporter_name')->nullable();
            $table->string('reporter_contact')->nullable();
            $table->string('type'); // Injury, Missing, Stray
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('status')->default('Pending'); // Pending, Reviewed, Resolved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
