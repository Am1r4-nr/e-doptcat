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
        Schema::table('cats', function (Blueprint $table) {
            $table->integer('ai_match_score')->default(0)->after('status'); // 0-100
            $table->string('location_name')->nullable()->after('ai_match_score'); // e.g., "University Campus A"
            $table->boolean('vaccinated')->default(false)->after('location_name');
            $table->string('health_status')->default('Healthy')->after('vaccinated'); // Healthy, Recovering, etc
            $table->string('personality')->nullable()->after('health_status'); // e.g., "Friendly, Playful"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn(['ai_match_score', 'location_name', 'vaccinated', 'health_status', 'personality']);
        });
    }
};
