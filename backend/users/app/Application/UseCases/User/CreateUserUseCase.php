<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;
use App\Application\DTOs\User\CreateUserDataRequest;
use App\Application\DTOs\User\UserDataResponse;
use Exception;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class CreateUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Create new user
     *
     * @param CreateUserDataRequest $user
     * @return UserDataResponse
     * @throws Exception
     */

    public function execute(CreateUserDataRequest $user): UserDataResponse
    {
        $this->userExist($this->userService->getByEmail($user->email));

        $user->password = Hash::make($user->password);

        return UserDataResponse::from($this->userService->create($user));
    }

    /**
     * @throws Exception
     */
    private function userExist($user): void
    {
        if ($user) {
            throw new RuntimeException('User already exists');
        }
    }
}
