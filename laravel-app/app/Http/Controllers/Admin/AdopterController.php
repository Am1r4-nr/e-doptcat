<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdopterController extends Controller
{
    public function index()
    {
        $adopters = User::whereHas('adoptions')
            ->withCount([
                'adoptions',
                'adoptions as pending_count'  => fn($q) => $q->where('status', 'Pending'),
                'adoptions as approved_count' => fn($q) => $q->where('status', 'Approved'),
                'adoptions as rejected_count' => fn($q) => $q->where('status', 'Rejected'),
            ])
            ->with(['adoptions' => fn($q) => $q->latest()->limit(1)])
            ->latest()
            ->paginate(15);

        $totalAdopters    = User::whereHas('adoptions')->count();
        $approvedAdopters = User::whereHas('adoptions', fn($q) => $q->where('status', 'Approved'))->count();
        $pendingAdopters  = User::whereHas('adoptions', fn($q) => $q->where('status', 'Pending'))->count();

        return view('admin.adopters.index', compact(
            'adopters',
            'totalAdopters',
            'approvedAdopters',
            'pendingAdopters',
        ));
    }

    public function show(User $user)
    {
        $user->load(['adoptions.cat']);
        return view('admin.adopters.show', compact('user'));
    }
}
