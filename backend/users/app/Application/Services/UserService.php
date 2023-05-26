<?php

namespace App\Application\Services;

use App\Application\Contracts\Repositories\iUserRepository;
use App\Application\Contracts\Services\iUserService;
use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UpdateUserDataRequest;
use App\Models\User;

class UserService implements iUserService
{

    public function __construct(private readonly iUserRepository $repository)
    {

    }

    /**
     * @inheritDoc
     */
    public function getAll(): mixed
    {
        return $this->repository->getAll();
    }

    /**
     * @inheritDoc
     */
    public function paginate(): mixed
    {
        return $this->repository->paginate();
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?User
    {
        return $this->repository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function getByEmail(string $email): ?User
    {
        return $this->repository->getByEmail($email);
    }

    /**
     * @inheritDoc
     */
    public function create(CreateUserDataRequest $user): User
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UpdateUserDataRequest $user): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return $this->repository->delete($id);
    }
}
