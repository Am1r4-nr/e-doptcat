<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\HomeController::class)->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/scanner', 'scanner')->name('scanner');
Route::get('/tracker', App\Http\Controllers\TrackerController::class)->name('tracker');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('cats', CatController::class)->only(['index', 'show']);
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::get('donations', [DonationController::class, 'index'])->name('donations.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
    Route::resource('reports', ReportController::class)->only(['create', 'store']);
    Route::post('events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Add more admin management routes here
    });
});

require __DIR__ . '/auth.php';
