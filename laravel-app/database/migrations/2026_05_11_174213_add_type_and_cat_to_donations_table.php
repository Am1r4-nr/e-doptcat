<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->enum('type', ['donation', 'adoption_payment'])->default('donation')->after('user_id');
            $table->foreignId('cat_id')->nullable()->constrained()->nullOnDelete()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['cat_id']);
            $table->dropColumn(['type', 'cat_id']);
        });
    }
};
