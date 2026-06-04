<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->timestamp('gps_timestamp')->nullable()->after('gps_lng');
        });
    }

    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn('gps_timestamp');
        });
    }
};
