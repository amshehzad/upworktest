<?php

namespace App\Models;

use App\Mail\ProductPurchasedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public static function boot(): void
    {
        parent::boot();

        static::created(function (self $purchase) {
            $purchase->user->assignRole($purchase->getAssignableRole());

            \Mail::to($purchase->user)->send(new ProductPurchasedMail($purchase));
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAssignableRole()
    {
        if($this->product->category == 'b2c'){
            return 'B2C Customer';
        }

        if ($this->product->category == 'b2b'){
            return 'B2B Customer';
        }
    }
}
