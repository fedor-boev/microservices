<?php

declare(strict_types=1);

namespace App\Application\Contracts\Repositories;

use App\Application\DTOs\Auth\RegisterDataRequest;
use App\Application\DTOs\Auth\User\UpdatePasswordDataRequest;
use App\Application\DTOs\Auth\User\UpdateUserDataRequest;
use App\Models\User;

interface iAuthRepository
{
    /**
     * Get user by email
     *
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /**
     * Register new user
     *
     * @param RegisterDataRequest $user
     * @return User
     */
    public function create(RegisterDataRequest $user): User;

    /**
     * Update auth user
     *
     * @param int $id
     * @param UpdateUserDataRequest|UpdatePasswordDataRequest $user
     * @return bool
     */
    public function update(int $id, UpdateUserDataRequest|UpdatePasswordDataRequest $user): bool;
}
