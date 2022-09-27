<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'expires_on', 'paid_on'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
