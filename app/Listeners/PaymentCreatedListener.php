<?php

namespace App\Listeners;

use App\Events\PaymentCreatedEvent;
use App\Jobs\GetDollarValueJob;
use App\Notifications\PaymentCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentCreatedListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(PaymentCreatedEvent $event)
    {
        $payment = $event->payment;

        GetDollarValueJob::dispatch($payment);

        if ($payment->client){
            $payment->client->notify(new PaymentCreatedNotification($payment));
        }
    }
}
