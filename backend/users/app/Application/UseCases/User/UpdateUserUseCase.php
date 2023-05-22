<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;
use App\Application\DTOs\User\UpdateUserDataRequest;

class UpdateUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Update user
     *
     * @param int $id
     * @param UpdateUserDataRequest $user
     * @return bool
     */
    public function execute(int $id, UpdateUserDataRequest $user): bool
    {
        return$this->userService->update($id, $user);
    }
}
