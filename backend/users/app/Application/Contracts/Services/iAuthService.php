<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

use App\Models\User;

interface iAuthService
{
    /**
     * @param array $user
     * @return User|null
     */
    public function getByEmail(array $user): User|null;

    /**
     * @param array $user
     * @return User
     */
    public function create(array $user): User;

    /**
     * @param int $id
     * @param array $user
     * @return bool
     */
    public function update(int $id, array $user): bool;
}
