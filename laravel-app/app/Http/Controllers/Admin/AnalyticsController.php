<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Cat;
use App\Models\Donation;
use App\Models\Report;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalRecords   = Cat::count();
        $totalAdoptions = Adoption::where('status', 'Approved')->count();
        $donationsYtd   = Donation::whereYear('created_at', now()->year)->sum('amount') ?? 0;
        $effectiveness  = $totalRecords > 0
            ? round(($totalAdoptions / $totalRecords) * 100, 1)
            : 0;

        // Monthly adoptions for bar chart (last 7 months)
        $monthlyAdoptions = [];
        $monthlyLabels    = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyLabels[]    = $month->format('M');
            $monthlyAdoptions[] = Adoption::where('status', 'Approved')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // Monthly donations for line chart (last 7 months)
        $monthlyDonations = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyDonations[] = (float) Donation::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
        }

        // Population status
        $available  = Cat::where('status', 'Available')->count();
        $adopted    = Cat::where('status', 'Adopted')->count();
        $treatment  = Cat::whereNotIn('status', ['Available', 'Adopted'])->count();

        // Activity log
        $activityLog = Adoption::with('user', 'cat')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.analytics.index', compact(
            'totalRecords',
            'totalAdoptions',
            'donationsYtd',
            'effectiveness',
            'monthlyLabels',
            'monthlyAdoptions',
            'monthlyDonations',
            'available',
            'adopted',
            'treatment',
            'activityLog',
        ));
    }
}
