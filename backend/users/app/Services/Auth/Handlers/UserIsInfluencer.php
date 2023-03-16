<?php

namespace App\Services\Auth\Handlers;

use App\Models\User\User;

class UserIsInfluencer
{
    /**
     * Check if user is influencer
     *
     * @param string $scope
     * @param User $user
     * @return bool
     */
    public function handle(string $scope, User $user): bool
    {
        return $scope !== 'influencer' && $user->isInfluencer();
    }
}
