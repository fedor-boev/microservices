<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;

    // TODO: добавить через DI свой protected AuthService hasPermission

    public function before(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return false;
    }
}
