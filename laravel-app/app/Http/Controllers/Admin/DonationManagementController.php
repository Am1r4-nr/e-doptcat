<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Donation;

class DonationManagementController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'cat'])->latest()->paginate(15);
        $stats = [
            'total_donations'   => Donation::sum('amount') ?? 0,
            'donation_count'    => Donation::count(),
            'adoption_payments' => Donation::where('type', 'adoption_payment')->sum('amount'),
            'completed_cases'   => Adoption::where('status', 'approved')->count(),
        ];
        return view('admin.donations.index', compact('donations', 'stats'));
    }

    public function show(Donation $donation)
    {
        $donation->load('user');
        return view('admin.donations.show', compact('donation'));
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donation record deleted.');
    }
}
