<?php

namespace App\Services\Auth\UseCases\Token;

use App\Models\User\User;

class RevokeToken
{

    /**
     * Create user token
     *
     * @param User $user
     * @return bool
     */
    public function handle(User $user): bool
    {
        return $user->token()?->revoke();
    }
}
