<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Purchase::class, 'purchase');
    }

    public function cancel(Request $request, Purchase $purchase)
    {
        $purchase->update([
            'cancelled' => 1
        ]);

        $purchase->user->removeRole($purchase->getAssignableRole());

        return redirect()->route('home')->with('success', 'Purchased cancelled successfully');
    }
}
