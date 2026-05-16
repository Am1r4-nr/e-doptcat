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

        Stripe::setApiKey(config('services.stripe.secret'));

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
            \Log::warning('Donation success reached without session_id');
            return redirect()->route('donations.index');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);

            \Log::info('Stripe Session Retrieved', ['id' => $session->id, 'status' => $session->payment_status]);

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
                \Log::info('Donation record created successfully');
            } else if ($exists) {
                \Log::info('Donation record already exists for this session');
            } else {
                \Log::warning('Stripe session status not paid', ['status' => $session->payment_status]);
            }

            return view('donations.success', [
                'amount' => $session->metadata->amount,
                'transaction_id' => $session->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Error processing donation success', ['message' => $e->getMessage()]);
            return redirect()->route('donations.index')->with('error', 'There was an issue verifying your payment. Please contact support if the amount was deducted.');
        }
    }
}
