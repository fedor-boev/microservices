<?php

declare(strict_types=1);

namespace App\Application\UseCases\Auth\Password;

use App\Application\Contracts\Services\iAuthService;
use App\Application\DTOs\Auth\User\UpdatePasswordDataRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUseCase
{
    public function __construct(
        private readonly iAuthService $authService,
    )
    {
    }

    /**
     * Update current user password
     *
     * @param int $id
     * @param UpdatePasswordDataRequest $user
     * @return bool
     */
    public function execute(int $id, UpdatePasswordDataRequest $user): bool
    {
        $user->password = Hash::make($user->password);
        return $this->authService->update($id, $user);
    }
}
