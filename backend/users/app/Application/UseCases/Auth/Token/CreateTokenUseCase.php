<?php

declare(strict_types=1);

namespace App\Application\UseCases\Auth\Token;

use App\Application\DTOs\Auth\Errors\ErrorDataResponse;
use App\Application\DTOs\Auth\LoginDataRequest;
use App\Application\UseCases\Auth\Permission\PermissionUseCase;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CreateTokenUseCase
{
    public function __construct(
        private readonly PermissionUseCase  $permissionUseCase,
    )
    {

    }

    /**
     * Create new token
     *
     * @param LoginDataRequest $dto
     * @return JsonResponse
     * @throws \Throwable
     */
    public function execute(LoginDataRequest $dto): JsonResponse
    {
        $auth = Auth::attempt($dto->only('email', 'password')->all());

        if ($auth) {
            /** @var User $user */
            $user = Auth::user();

            throw_if(!$user, 'RuntimeException', 'User not found');

            /** @var $scope - auth as influencer or not */
            $scope = $dto->scope;

            if ($this->permissionUseCase->execute($user, $dto->scope)) {
                return response()->json(ErrorDataResponse::from(['message' => 'Access denied!']), Response::HTTP_FORBIDDEN);
            }

            $token = $user->createToken($scope, [$scope])->accessToken;

            return response()->json(['token' => $token], Response::HTTP_CREATED);
        }

        return response()->json(ErrorDataResponse::from(['message' => 'Invalid Credentials!']), Response::HTTP_UNAUTHORIZED);
    }
}
