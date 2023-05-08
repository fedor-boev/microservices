<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

use App\Application\DTOs\Auth\RegisterDataRequest;
use App\Application\DTOs\Auth\User\UpdatePasswordDataRequest;
use App\Application\DTOs\Auth\User\UpdateUserDataRequest;
use App\Models\User;

interface iAuthService
{
    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): User|null;

    /**
     * @param RegisterDataRequest $user
     * @return User
     */
    public function create(RegisterDataRequest $user): User;

    /**
     * @param int $id
     * @param UpdateUserDataRequest|UpdatePasswordDataRequest $user
     * @return bool
     */
    public function update(int $id, UpdateUserDataRequest|UpdatePasswordDataRequest $user): bool;
}
