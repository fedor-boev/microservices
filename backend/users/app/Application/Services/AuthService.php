<?php

namespace App\Application\Services;

use App\Application\Contracts\Repositories\iAuthRepository;
use App\Application\Contracts\Services\iAuthService;
use App\Application\DTOs\Auth\RegisterDataRequest;
use App\Application\DTOs\Auth\User\UpdatePasswordDataRequest;
use App\Application\DTOs\Auth\User\UpdateUserDataRequest;
use App\Models\User;

class AuthService implements iAuthService
{
    public function __construct(private readonly iAuthRepository $authRepository) {

    }

    /**
     * @inheritDoc
     */
    public function getByEmail(string $email): ?User
    {
        return $this->authRepository->getByEmail($email);
    }

    /**
     * @inheritDoc
     */
    public function create(RegisterDataRequest $user): User
    {
        return $this->authRepository->create($user);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UpdatePasswordDataRequest|UpdateUserDataRequest $user): bool
    {
        return $this->authRepository->update($id, $user);
    }
}
