<?php

use App\Http\Controllers\GpsDeviceController;
use App\Http\Controllers\GpsController;
use Illuminate\Support\Facades\Route;

/**
 * GPS Device Management Routes (Admin Only)
 */
Route::middleware(['auth', 'admin'])->group(function () {
    
    // GPS Device Management
    Route::get('/admin/gps-devices', [GpsDeviceController::class, 'index'])->name('gps.devices.index');
    Route::post('/admin/gps-devices', [GpsDeviceController::class, 'store'])->name('gps.devices.store');
    Route::delete('/admin/gps-devices/{device}', [GpsDeviceController::class, 'destroy'])->name('gps.devices.destroy');
    Route::patch('/admin/gps-devices/{device}/toggle', [GpsDeviceController::class, 'toggle'])->name('gps.devices.toggle');
    
    // Synchronization
    Route::post('/admin/gps-devices/{device}/sync', [GpsDeviceController::class, 'syncDevice'])->name('gps.devices.sync');
    Route::post('/admin/gps-devices/sync-all', [GpsDeviceController::class, 'syncAll'])->name('gps.devices.sync-all');
    Route::get('/admin/gps-devices/{device}/history', [GpsDeviceController::class, 'history'])->name('gps.devices.history');
    
    // Testing
    Route::get('/admin/gps/test-connection', [GpsDeviceController::class, 'testConnection'])->name('gps.test-connection');
    
    // 365GPS.net API Testing
    Route::get('/admin/gps/location', [GpsController::class, 'getLocation'])->name('gps.location');
    Route::post('/admin/gps/location/save', [GpsController::class, 'getLocationAndSave'])->name('gps.location.save');
});

/**
 * GPS API Test Routes (No Auth Required - Development Only)
 */
if (app()->environment('local')) {
    Route::get('/api/gps/location', [GpsController::class, 'getLocation'])->name('api.gps.location');
    Route::post('/api/gps/location/save', [GpsController::class, 'getLocationAndSave'])->name('api.gps.location.save');
}
