<?php

namespace App\Jobs;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetDollarValueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Payment $payment;

    private static $url = 'https://mindicador.cl/api/dolar';

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function handle()
    {
        $response = Http::get(self::$url);

        if (!$response->successful()){
            Log::error('API failed!');
            // do all necessary steps on fail
        }

        $data = json_decode($response->body(), 1);
        $values = $data['serie'];

        $current_value = Cache::remember('dollar_'. now()->format('d-m-Y'), now()->endOfDay(),
            function () use ($values) {
                return \Arr::first($values, function ($value){
                    $date = Carbon::make($value['fecha'])->format('d-m-Y');
                    return $date == now()->format('d-m-Y');
                })['valor'] ?? null;
            }
        );

        $this->payment->update([
            'clp_usd' => $current_value
        ]);

    }
}
