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
        $stats = [
            'total_cats' => Cat::count(),
            'available_cats' => Cat::where('status', 'Available')->count(),
            'total_adoptions' => Adoption::count(),
            'pending_adoptions' => Adoption::where('status', 'Pending')->count(),
            'total_donations' => Donation::sum('amount'),
            'recent_reports' => Report::with('user')->latest()->take(5)->get(),
            'monthly_donations' => Donation::whereYear('created_at', date('Y'))
                ->selectRaw('strftime("%m", created_at) as month, sum(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
