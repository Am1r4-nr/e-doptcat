<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Adoption;
use App\Models\Donation;
use App\Models\Report;
use App\Models\User;
use App\Models\Event;
use App\Models\Volunteer;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {
            $months       = collect(range(5, 0))->map(fn($i) => now()->subMonths($i));
            $monthLabels  = $months->map(fn($m) => $m->format('M'))->values()->toArray();

            $monthlyAdoptions = $months->map(fn($m) =>
                Adoption::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count()
            )->values()->toArray();

            $monthlyIntake = $months->map(fn($m) =>
                Cat::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count()
            )->values()->toArray();

            $monthlyDonations = $months->map(fn($m) =>
                (float) Donation::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->sum('amount')
            )->values()->toArray();

            $monthlyUsers = $months->map(fn($m) =>
                User::where('role', 'user')->whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count()
            )->values()->toArray();

            $catsByStatus = Cat::selectRaw('status, count(*) as total')
                ->groupBy('status')->get()->pluck('total', 'status')->toArray();

            $stageOrder       = ['New', 'Inquiry', 'Screening', 'Matching', 'Approved'];
            $adoptionsByStage = collect($stageOrder)->mapWithKeys(
                fn($s) => [$s => Adoption::where('pipeline_stage', $s)->count()]
            )->toArray();

            $cur  = now();
            $prev = now()->subMonth();

            $curAdoptions  = Adoption::whereYear('created_at', $cur->year)->whereMonth('created_at', $cur->month)->count();
            $prevAdoptions = Adoption::whereYear('created_at', $prev->year)->whereMonth('created_at', $prev->month)->count();

            $curCats  = Cat::whereYear('created_at', $cur->year)->whereMonth('created_at', $cur->month)->count();
            $prevCats = Cat::whereYear('created_at', $prev->year)->whereMonth('created_at', $prev->month)->count();

            $curUsers  = User::where('role', 'user')->whereYear('created_at', $cur->year)->whereMonth('created_at', $cur->month)->count();
            $prevUsers = User::where('role', 'user')->whereYear('created_at', $prev->year)->whereMonth('created_at', $prev->month)->count();

            $curDon  = (float) Donation::whereYear('created_at', $cur->year)->whereMonth('created_at', $cur->month)->sum('amount');
            $prevDon = (float) Donation::whereYear('created_at', $prev->year)->whereMonth('created_at', $prev->month)->sum('amount');

            $pct = fn($c, $p) => $p > 0 ? round(($c - $p) / $p * 100, 1) : ($c > 0 ? 100.0 : 0.0);

            $stats = [
                'total_cats'           => Cat::count(),
                'total_adoptions'      => Adoption::count(),
                'total_users'          => User::where('role', 'user')->count(),
                'total_donations'      => Donation::sum('amount') ?? 0,
                'total_volunteers'     => Volunteer::count(),
                'adoptions_this_month' => $curAdoptions,
                'recent_reports'       => Report::with('user')->latest()->take(5)->get(),
                'recent_donors'        => Donation::with('user')->latest()->take(5)->get(),
                'upcoming_event'       => Event::where('event_date', '>', now())->orderBy('event_date')->first(),
                'cats_by_status'       => $catsByStatus,
                'adoptions_by_stage'   => $adoptionsByStage,
                'month_labels'         => $monthLabels,
                'monthly_adoptions'    => $monthlyAdoptions,
                'monthly_intake'       => $monthlyIntake,
                'monthly_donations'    => $monthlyDonations,
                'monthly_users'        => $monthlyUsers,
                'cat_change'           => $pct($curCats, $prevCats),
                'adoption_change'      => $pct($curAdoptions, $prevAdoptions),
                'user_change'          => $pct($curUsers, $prevUsers),
                'donation_change'      => $pct($curDon, $prevDon),
            ];

            return view('admin.dashboard', compact('stats'));
        } catch (\Exception $e) {
            \Log::error('Admin Dashboard Error: ' . $e->getMessage());

            $zeros = [0, 0, 0, 0, 0, 0];

            return view('admin.dashboard', ['stats' => [
                'total_cats' => 0, 'total_adoptions' => 0, 'total_users' => 0,
                'total_donations' => 0, 'total_volunteers' => 0, 'adoptions_this_month' => 0,
                'recent_reports' => collect([]), 'recent_donors' => collect([]),
                'upcoming_event' => null,
                'cats_by_status' => [], 'adoptions_by_stage' => [],
                'month_labels' => ['Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'],
                'monthly_adoptions' => $zeros, 'monthly_intake' => $zeros,
                'monthly_donations' => $zeros, 'monthly_users' => $zeros,
                'cat_change' => 0, 'adoption_change' => 0, 'user_change' => 0, 'donation_change' => 0,
            ]]);
        }
    }
}
