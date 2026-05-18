<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GpsController;
use App\Http\Controllers\Admin\CatManagementController;
use App\Http\Controllers\Admin\AdopterController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\EventManagementController;
use App\Http\Controllers\Admin\AdoptionManagementController;
use App\Http\Controllers\Admin\ReportManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ReportingController;
use App\Http\Controllers\Admin\DonationManagementController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\IncidentManagementController;
use App\Http\Controllers\Admin\MessageManagementController;
use App\Http\Controllers\Admin\CalendarManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\HomeController::class)->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/scanner', 'scanner')->name('scanner');
Route::get('/tracker', App\Http\Controllers\TrackerController::class)->name('tracker');

Route::get('/dashboard', function () {
    if (auth()->user()->getAttribute('role') === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('cats', CatController::class)->only(['index', 'show']);
Route::post('cats/ai-preferences', [CatController::class, 'storeAiPreferences'])->name('cats.ai-preferences');
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::get('donations', [DonationController::class, 'index'])->name('donations.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('donations/success', [DonationController::class, 'success'])->name('donations.success');

    Route::resource('reports', ReportController::class)->only(['create', 'store']);
    Route::post('events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AnalyticsController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index'); // Kept for alias compatibility
        Route::get('/reporting', [ReportingController::class, 'index'])->name('reporting.index');

        // Cat Management
        Route::resource('cats', CatManagementController::class)->except(['edit', 'update']);
        Route::patch('cats/{cat}/fields', [CatManagementController::class, 'updateFields'])->name('cats.updateFields');

        // Adopter Management
        Route::get('adopters', [AdopterController::class, 'index'])->name('adopters.index');
        Route::get('adopters/{user}', [AdopterController::class, 'show'])->name('adopters.show');

        // Adoption Management
        Route::get('adoptions/pipeline', [AdoptionManagementController::class, 'pipeline'])->name('adoptions.pipeline');
        Route::resource('adoptions', AdoptionManagementController::class)->only(['index', 'show', 'destroy']);
        Route::patch('adoptions/{adoption}/approve', [AdoptionManagementController::class, 'approve'])->name('adoptions.approve');
        Route::patch('adoptions/{adoption}/reject', [AdoptionManagementController::class, 'reject'])->name('adoptions.reject');

        // Volunteer Management
        Route::get('volunteers', [\App\Http\Controllers\Admin\VolunteerController::class, 'index'])->name('volunteers.index');
        Route::post('volunteers/import', [\App\Http\Controllers\Admin\VolunteerController::class, 'import'])->name('volunteers.import');
        Route::post('volunteers', [\App\Http\Controllers\Admin\VolunteerController::class, 'store'])->name('volunteers.store');
        Route::patch('volunteers/{volunteer}/status', [\App\Http\Controllers\Admin\VolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');
        Route::patch('volunteers/{volunteer}', [\App\Http\Controllers\Admin\VolunteerController::class, 'update'])->name('volunteers.update');

        // Report Management
        Route::resource('reports', ReportManagementController::class)->only(['index', 'show', 'destroy']);
        Route::patch('reports/{report}/status', [ReportManagementController::class, 'updateStatus'])->name('reports.status');

        // User Management
        Route::resource('users', UserManagementController::class)->only(['index', 'show', 'destroy']);
        Route::patch('users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.role');

        // Messages
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');

        // Donation Management
        Route::resource('donations', DonationManagementController::class)->only(['index', 'show', 'destroy']);
        Route::get('expenses', function() { return view('admin.expenses.index'); })->name('expenses.index');

        // Web Management
        Route::resource('events', EventManagementController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
        Route::get('calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    });
});

// GPS API Test Routes (No Auth Required - Development Only)
if (app()->environment('local')) {
    Route::get('/api/gps/location', [GpsController::class, 'getLocation'])->name('api.gps.location');
    Route::get('/api/gps/location/save', [GpsController::class, 'getLocationAndSave'])->name('api.gps.location.save');
    Route::post('/api/gps/location/save', [GpsController::class, 'getLocationAndSave'])->name('api.gps.location.save.post');
    Route::get('/api/gps/test', [GpsController::class, 'testConnection'])->name('api.gps.test');
    Route::get('/api/gps/update', [GpsController::class, 'updateLocation'])->name('api.gps.update');

    // Admin Dashboard Test Routes (No Auth Required for Testing)
    Route::get('/admin/dashboard-test', [AdminDashboardController::class, 'index'])->name('admin.dashboard.test');
    Route::get('/admin/plain-test', function () {
        return response()->html('<!DOCTYPE html><html><head><title>Plain Test</title></head><body style="font-family: Arial; padding: 20px;"><h1>Admin Dashboard - Plain HTML Test</h1><p>If you see this, the server is working fine.</p><div style="background: #f0f0f0; padding: 15px; margin-top: 20px;"><strong>Database Status:</strong><br>Total Cats: ' . \App\Models\Cat::count() . '<br>Admin User: ' . (\App\Models\User::where('role', 'admin')->count() > 0 ? 'Yes' : 'No') . '</div></body></html>');
    })->name('plain.test');

    Route::get('/test', function () {
        return '<html><body><h1>HELLO WORLD</h1><p>Server is working!</p></body></html>';
    })->name('test');
    Route::get('/admin/dashboard-minimal', function () {
        $stats = [];
        try {
            $stats['total_cats'] = \App\Models\Cat::count();
            $stats['available_cats'] = \App\Models\Cat::where('status', 'Available')->count();
            $stats['total_adoptions'] = \App\Models\Adoption::count();
            $stats['pending_adoptions'] = \App\Models\Adoption::where('status', 'Pending')->count();
            $stats['total_donations'] = \App\Models\Donation::sum('amount') ?? 0;
            $stats['recent_reports'] = \App\Models\Report::with('user')->latest()->take(5)->get();
            $stats['monthly_donations'] = [];
        } catch (Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
        }
        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard.minimal');
    Route::get('/admin/dashboard-debug', function () {
        $stats = [
            'total_cats' => 0,
            'available_cats' => 0,
            'total_adoptions' => 0,
            'pending_adoptions' => 0,
            'total_donations' => 0,
            'recent_reports' => collect([]),
            'monthly_donations' => [],
        ];
        return view('admin.dashboard-debug', compact('stats'));
    })->name('admin.dashboard.debug');
}

require __DIR__ . '/auth.php';
