<?php

namespace App\Domain\Repositories;

use App\Application\Contracts\Repositories\iAuthRepository;
use App\Application\DTOs\Auth\RegisterDataRequest;
use App\Application\DTOs\Auth\User\UpdatePasswordDataRequest;
use App\Application\DTOs\Auth\User\UpdateUserDataRequest;
use App\Models\User;

class AuthRepository implements iAuthRepository
{
    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function create(RegisterDataRequest $user): User
    {
        return User::create($user);
    }

    public function update(int $id, UpdatePasswordDataRequest|UpdateUserDataRequest $user): bool
    {
        return User::whereId($id)->update($user->all());
    }
}
