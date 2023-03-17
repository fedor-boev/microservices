<?php

namespace App\Services\Auth\Handlers\Token;

use App\Models\User\User;

class RevokeTokenHandler
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
