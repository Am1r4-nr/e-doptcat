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
            $table->integer('temperament_score')->nullable()->default(5)->after('ai_match_score');
            $table->longText('ai_profile')->nullable()->after('temperament_score');
            $table->text('ideal_adopters')->nullable()->after('ai_profile');
            $table->text('care_notes')->nullable()->after('ideal_adopters');
            $table->text('behavior_notes')->nullable()->after('care_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn([
                'temperament_score',
                'ai_profile',
                'ideal_adopters',
                'care_notes',
                'behavior_notes',
            ]);
        });
    }
};
