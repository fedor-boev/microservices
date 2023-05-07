<?php

declare(strict_types=1);

namespace App\Application\Contracts\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface iUserRepository
{
    /**
     * Get collection of users
     *
     * @return Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get paginate by users
     *
     * @return LengthAwarePaginator
     */
    public function paginate(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get user by id
     *
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * Create user
     *
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User;

    /**
     * Update user
     *
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * Delete user
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
