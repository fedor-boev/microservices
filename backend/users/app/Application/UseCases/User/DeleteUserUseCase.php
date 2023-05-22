<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;

class DeleteUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Delete user
     *
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        return $this->userService->delete($id);
    }
}
