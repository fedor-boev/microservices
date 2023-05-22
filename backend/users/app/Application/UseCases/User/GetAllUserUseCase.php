<?php

declare(strict_types=1);

namespace App\Application\UseCases\User;

use App\Application\Contracts\Services\iUserService;
use App\Application\DTOs\User\UserDataResponse;
use Spatie\LaravelData\DataCollection;

class GetAllUserUseCase
{
    public function __construct(
        private readonly iUserService $userService
    )
    {

    }

    /**
     * Get list of users
     *
     * @return DataCollection
     */
    public function execute(): DataCollection
    {
        return UserDataResponse::collection($this->userService->getAll());
    }
}
