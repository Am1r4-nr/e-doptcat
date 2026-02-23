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
        Schema::create('gps_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->constrained('cats')->onDelete('cascade');
            $table->string('imei')->unique();
            $table->string('device_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sync_at')->nullable();
            $table->decimal('last_known_lat', 10, 8)->nullable();
            $table->decimal('last_known_lng', 11, 8)->nullable();
            $table->timestamps();
            
            $table->index('imei');
            $table->index('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_devices');
    }
};
