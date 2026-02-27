<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationManagementController extends Controller
{
    public function index()
    {
        $donations = Donation::with('user')->paginate(15);
        $stats = [
            'total_donations' => Donation::sum('amount'),
            'average_donation' => Donation::avg('amount'),
            'donation_count' => Donation::count(),
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
