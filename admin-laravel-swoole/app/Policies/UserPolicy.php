<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends BasePolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

//    public function viewAny(User $user): bool
//    {
//        return $user->isModerator();
//        $this->authService->hasUserPermission($user, 'view')
//    }
}
