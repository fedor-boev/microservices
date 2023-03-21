<?php

namespace App\Modules\Auth\Services\UseCases\Token;

use App\Modules\User\Models\User;

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
