<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UpdateUserDataRequest;
use App\Domain\Entities\User;

interface iUserService
{
    public function getAll(): array;

    public function paginate(): array;

    public function getById(int $id): ?User;

    public function getByEmail(string $email): ?User;

    public function create(CreateUserDataRequest $user): User;

    public function update(int $id, UpdateUserDataRequest $user): bool;

    public function delete(int $id): int;
}
