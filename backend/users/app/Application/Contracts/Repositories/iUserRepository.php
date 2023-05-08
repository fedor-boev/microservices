<?php

declare(strict_types=1);

namespace App\Application\Contracts\Repositories;

use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UpdateUserDataRequest;
use App\Domain\Entities\User;

interface iUserRepository
{
    /**
     * Get collection of users
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get paginate by users
     *
     * @return array
     */
    public function paginate(): array;

    /**
     * Get user by id
     *
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * Get user by email
     *
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /**
     * Create user
     *
     * @param CreateUserDataRequest $user
     * @return User
     */
    public function create(CreateUserDataRequest $user): User;

    /**
     * Update user
     *
     * @param int $id
     * @param UpdateUserDataRequest $user
     * @return bool
     */
    public function update(int $id, UpdateUserDataRequest $user): bool;

    /**
     * Delete user
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
