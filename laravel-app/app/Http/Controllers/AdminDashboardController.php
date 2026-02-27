<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Adoption;
use App\Models\Donation;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {
            $stats = [
                'total_cats' => Cat::count(),
                'total_adoptions' => Adoption::count(),
                'total_users' => User::where('role', 'user')->count(),
                'total_donations' => Donation::sum('amount') ?? 0,
                'adoptions_this_month' => Adoption::whereMonth('created_at', now()->month)->count(),
                'recent_reports' => Report::with('user')->latest()->take(5)->get(),
            ];

            return view('admin.dashboard', compact('stats'));
        } catch (\Exception $e) {
            \Log::error('Admin Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard', ['stats' => [
                'total_cats' => 0,
                'total_adoptions' => 0,
                'total_users' => 0,
                'total_donations' => 0,
                'adoptions_this_month' => 0,
                'recent_reports' => collect([]),
            ]]);
        }
    }
}

