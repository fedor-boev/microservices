<?php

namespace App\Services\Auth\Handlers\Token;

use App\Models\User\User;

class CreateTokenHandler
{

    /**
     * Create user token
     *
     * @param User $user
     * @param string $scope
     * @return string
     */
    public function handle(User $user, string $scope): string
    {
        return $user->createToken($scope, [$scope])->accessToken;
    }
}
