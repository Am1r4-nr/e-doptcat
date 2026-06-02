<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Adoption;
use App\Models\Donation;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use App\Models\Event;
use App\Models\Volunteer;
use Illuminate\Support\Str;

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

    public function notifications(): \Illuminate\Http\JsonResponse
    {
        $items = collect();

        // Pending adoption applications
        Adoption::with(['user', 'cat'])
            ->where('status', 'Pending')
            ->latest()->take(5)->get()
            ->each(fn($a) => $items->push([
                'title'    => 'New Adoption Request',
                'subtitle' => ($a->user?->name ?? 'Someone') . ' wants to adopt ' . ($a->cat?->name ?? 'a cat'),
                'time'     => $a->created_at->diffForHumans(),
                'url'      => route('admin.adoptions.show', $a),
                'sort'     => $a->created_at->timestamp,
                'iconBg'   => 'bg-amber-100',
                'icon'     => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>',
            ]));

        // Pending reports
        Report::where('status', 'Pending')
            ->latest()->take(5)->get()
            ->each(fn($r) => $items->push([
                'title'    => 'Report Submitted',
                'subtitle' => Str::limit($r->type ?? 'New report received', 60),
                'time'     => $r->created_at->diffForHumans(),
                'url'      => route('admin.reports.show', $r),
                'sort'     => $r->created_at->timestamp,
                'iconBg'   => 'bg-red-100',
                'icon'     => '<svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>',
            ]));

        // Pending volunteer applications
        Volunteer::where('status', 'Pending')
            ->latest()->take(5)->get()
            ->each(fn($v) => $items->push([
                'title'    => 'Volunteer Application',
                'subtitle' => ($v->name ?? 'Someone') . ' applied to volunteer',
                'time'     => $v->created_at->diffForHumans(),
                'url'      => route('admin.volunteers.index'),
                'sort'     => $v->created_at->timestamp,
                'iconBg'   => 'bg-teal-100',
                'icon'     => '<svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
            ]));

        // Unread messages sent to this admin
        Message::with('sender')
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->latest()->take(5)->get()
            ->each(fn($m) => $items->push([
                'title'    => 'New Message',
                'subtitle' => 'From ' . ($m->sender?->name ?? 'Unknown') . ': ' . Str::limit($m->subject ?? $m->content ?? '', 45),
                'time'     => $m->created_at->diffForHumans(),
                'url'      => route('admin.messages.index'),
                'sort'     => $m->created_at->timestamp,
                'iconBg'   => 'bg-blue-100',
                'icon'     => '<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>',
            ]));

        $sorted = $items->sortByDesc('sort')->values()
            ->map(fn($i) => collect($i)->except('sort')->all());

        return response()->json([
            'count' => $sorted->count(),
            'items' => $sorted,
        ]);
    }
}
