<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    // Show checkout page
    public function checkout()
    {
        return view('checkout');
    }

    // Process the payment
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.5',
            'email' => 'nullable|email',
            'stripeToken' => 'required',
        ]);

        // Convert amount to cents
        $amount = $request->amount * 100;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'receipt_email' => $request->email,
                'description' => 'Payment Test',
            ]);

            // Save payment in DB
            Payment::create([
                'user_email' => $request->email,
                'stripe_charge_id' => $charge->id,
                'amount' => $amount,
                'currency' => 'usd',
                'status' => $charge->status,
            ]);

            return redirect()->back()->with('success', 'Payment Successful!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
