<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    public function cancel(User $user, Purchase $purchase): bool
    {
        if ($purchase->cancelled) {
            return false;
        }

        return $purchase->user_id == $user->id;
    }
}
