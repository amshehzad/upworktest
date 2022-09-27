<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Payment */
class PaymentResource extends JsonResource
{
    /**
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'paid_on' => $this->paid_on,
            'expires_on' => $this->expires_on->format('Y-m-d'),
            'status' => $this->status,
            'client_id' => $this->client_id,
            'clp_usd' => $this->clp_usd,
        ];
    }
}
