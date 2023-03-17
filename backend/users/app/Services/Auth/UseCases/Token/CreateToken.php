<?php

namespace App\Services\Auth\UseCases\Token;

use App\Models\User\User;

class CreateToken
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
