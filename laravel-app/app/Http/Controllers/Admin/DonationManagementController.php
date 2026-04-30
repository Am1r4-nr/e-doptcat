<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;

class DonationManagementController extends Controller
{
    public function index()
    {
        $donations = Donation::with('user')->paginate(15);
        $aggregate = Donation::selectRaw('SUM(amount) as total, AVG(amount) as average, COUNT(*) as count')->first();
        $stats = [
            'total_donations' => $aggregate->total ?? 0,
            'average_donation' => $aggregate->average ?? 0,
            'donation_count' => $aggregate->count ?? 0,
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
