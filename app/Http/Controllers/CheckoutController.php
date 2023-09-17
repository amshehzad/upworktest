<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class CheckoutController extends Controller
{
    public function index(Request $request, Product $product)
    {
        return $request->user()->checkout($product->stripe_price_id, [
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'product_id' => $product->id,
            ]
        ]);
    }

    public function success(Request $request)
    {
        $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $pi = Cashier::stripe()->paymentIntents->retrieve($checkoutSession->payment_intent);
        $pm = Cashier::stripe()->paymentMethods->retrieve($pi->payment_method);

        Purchase::create([
            'user_id' => $request->user()->id,
            'product_id' => $checkoutSession->metadata->product_id,
            'last_4_digits' => $pm->card->last4
        ]);

        return redirect()->route('home')->with('success', 'Payment successful');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('products.index');
    }
}
