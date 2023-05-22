<?php

namespace App\Domain\Repositories;

use App\Application\Contracts\Repositories\iUserRepository;
use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UpdateUserDataRequest;
use App\Models\User;

class UserRepository implements iUserRepository
{

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @inheritDoc
     */
    public function paginate(): array
    {
        // TODO: Implement paginate() method.
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @inheritDoc
     */
    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(CreateUserDataRequest $user): User
    {
        return User::create($user);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UpdateUserDataRequest $user): bool
    {
        return User::whereId($id)->update($user->all());
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return User::whereId($id)->delete();
    }
}
