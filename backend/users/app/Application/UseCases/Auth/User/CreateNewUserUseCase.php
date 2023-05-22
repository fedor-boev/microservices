<?php

declare(strict_types=1);

namespace App\Application\UseCases\Auth\User;

use App\Application\DTOs\Auth\Errors\ErrorDataResponse;
use App\Application\DTOs\Auth\RegisterDataRequest;
use App\Application\DTOs\Auth\User\UserDataResponse;
use App\Application\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CreateNewUserUseCase
{
    public function __construct(
        private readonly AuthService $authService,
    )
    {

    }

    /**
     * Make registration new user
     *
     * @param RegisterDataRequest $dto
     * @return JsonResponse
     */
    public function execute(RegisterDataRequest $dto): JsonResponse
    {
        $user = $dto->additional([
            'password' => Hash::make($dto->password),
            'is_influencer' => 1
        ]);

        $exist = $this->authService->getByEmail($user->email);

        if ($exist) {
            return response()->json(ErrorDataResponse::from(['message' => 'user already exists']), Response::HTTP_CONFLICT);
        }

        $user = $this->authService->create($user);

        return response()->json(UserDataResponse::from($user), Response::HTTP_CREATED);
    }
}
