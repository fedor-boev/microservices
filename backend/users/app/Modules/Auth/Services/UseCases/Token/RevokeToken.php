<?php

namespace App\Modules\Auth\Services\UseCases\Token;

use App\Modules\User\Models\User;

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
