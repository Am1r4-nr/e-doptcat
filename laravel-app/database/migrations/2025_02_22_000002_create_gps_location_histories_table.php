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
        Schema::create('gps_location_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gps_device_id')->constrained('gps_devices')->onDelete('cascade');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->integer('accuracy')->nullable();
            $table->decimal('speed', 8, 2)->nullable();
            $table->integer('direction')->nullable();
            $table->timestamp('timestamp');
            $table->timestamps();
            
            $table->index('gps_device_id');
            $table->index('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_location_histories');
    }
};
