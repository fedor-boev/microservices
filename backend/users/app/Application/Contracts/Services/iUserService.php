<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UpdateUserDataRequest;
use App\Models\User;

interface iUserService
{
    /**
     * Get all users
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * Get paginated users
     * @return mixed
     */
    public function paginate(): mixed;

    /**
     * Get user
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * Get user
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /**
     * Create user
     * @param CreateUserDataRequest $user
     * @return User
     */
    public function create(CreateUserDataRequest $user): User;

    /**
     * Update user
     * @param int $id
     * @param UpdateUserDataRequest $user
     * @return bool
     */
    public function update(int $id, UpdateUserDataRequest $user): bool;

    /**
     * Delete user
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
