<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;

class PaginateUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Get pagination by users
     *
     * @return array
     */
    public function execute(): array
    {
        return $this->userService->paginate();
    }
}
