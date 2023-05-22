<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;
use App\Application\DTOs\User\UserDataResponse;

class GetUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Get user
     *
     * @param int $id
     * @return UserDataResponse
     */
    public function execute(int $id): UserDataResponse
    {
        $user = $this->userService->getById($id);
        if ($user === null) {
            throw new \RuntimeException('User not found');
        }

        return UserDataResponse::from($user);
    }
}
