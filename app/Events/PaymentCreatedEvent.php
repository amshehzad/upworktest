<?php

namespace App\Events;

use App\Models\Payment;
use Illuminate\Foundation\Events\Dispatchable;

class PaymentCreatedEvent
{
    use Dispatchable;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
