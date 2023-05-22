<?php

declare(strict_types=1);

namespace App\Application\UseCases\Auth\User;

use App\Application\DTOs\Auth\User\UpdateUserDataRequest;
use App\Application\Services\AuthService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserInfoUseCase
{
    public function __construct(
        private readonly AuthService $authService
    )
    {

    }

    /**
     * Update current user info
     *
     * @param UpdateUserDataRequest $user
     * @return JsonResponse
     * @throws \Throwable
     */
    public function execute(UpdateUserDataRequest $user): JsonResponse
    {
        /** @var User $user */
        $id = Auth::id();

        throw_if(!$id, 'RuntimeException', 'User not found');

        $updated = $this->authService->update($id, $user);

        return response()->json(['result' => $updated], Response::HTTP_OK);
    }
}
