<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function toggleAccess(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }
}
