<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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
            'payment_method' => 'required|string|in:fpx,card',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentMethodTypes = $validated['payment_method'] === 'fpx' ? ['fpx'] : ['card'];
        
        // Create a Stripe Checkout Session
        $session = Session::create([
            'payment_method_types' => $paymentMethodTypes,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => 'Donation to E-DoptCat',
                        'description' => 'Support our furry friends!',
                    ],
                    'unit_amount' => $validated['amount'] * 100, // Stripe uses cents (sen)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('donations.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('donations.index'),
            'metadata' => [
                'user_id' => auth()->id(),
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('donations.index');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($sessionId);

        // Check if donation already exists for this session to prevent duplicates on refresh
        $exists = Donation::where('transaction_id', $session->id)->exists();

        if (!$exists && $session->payment_status === 'paid') {
            Donation::create([
                'user_id' => $session->metadata->user_id,
                'amount' => $session->metadata->amount,
                'payment_method' => $session->metadata->payment_method,
                'status' => 'Completed',
                'transaction_id' => $session->id,
            ]);
        }

        return view('donations.index')->with('success', 'Thank you for your generous RM ' . $session->metadata->amount . ' donation! Your support makes a real difference.');
    }
}
