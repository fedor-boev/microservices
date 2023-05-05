<?php

declare(strict_types=1);

namespace App\Application\Contracts\Repositories;

use App\Models\User;

interface iAuthRepository
{
    /**
     * Get user by email
     *
     * @param array $user
     * @return User|null
     */
    public function getByEmail(array $user): User|null;

    /**
     * Register new user
     *
     * @param array $user
     * @return User
     */
    public function create(array $user): User;

    /**
     * Update auth user
     *
     * @param int $id
     * @param array $user
     * @return bool
     */
    public function update(int $id, array $user): bool;
}
