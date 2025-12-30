<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('donations.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);

        // Mock ToyyibPay Integration
        Donation::create([
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'Completed', // Auto-complete for mock
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
        ]);

        return back()->with('success', 'Thank you for your donation!');
    }
}
