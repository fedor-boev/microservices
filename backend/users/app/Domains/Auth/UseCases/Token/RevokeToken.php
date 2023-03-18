<?php

namespace App\Domains\Auth\UseCases\Token;

use App\Domains\User\Models\User;

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
