<?php

namespace App\Http\Controllers\Api;

use App\Events\PaymentCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::when(
            $client_id = \request('client_id'),
            fn($query) => $query->where('client_id', $client_id)
        )->get();

        return PaymentResource::collection($payments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id'
        ]);

        $payment = Payment::create([
            'uuid' => str()->uuid(),
            'client_id' => $request->client_id,
            'expires_on' => now()->addDays(3),
            'status' => 'pending'
        ]);

        PaymentCreatedEvent::dispatch($payment);

        return new PaymentResource($payment);
    }
}
