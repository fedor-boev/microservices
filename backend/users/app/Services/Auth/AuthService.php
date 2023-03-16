<?php

namespace App\Services\Auth;

use App\Contracts\Services\Auth\iAuthService;
use App\Data\Requests\Auth\LoginData;
use App\Data\Requests\Auth\RegisterData;
use App\Http\Resources\Auth\TokenResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\Auth\Handlers\CreateToken;
use App\Services\Auth\Handlers\UserIsInfluencer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Contracts\DataObject;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements iAuthService
{
    // TODO: добавить интерфейсы
    public function __construct(
        private readonly UserIsInfluencer $userIsInfluencer,
        private readonly CreateToken $createToken,
        private readonly UserRepository $userRepository
    )
    {

    }

    /**
     * @inheritDoc
     */
    public function createToken(LoginData|DataObject $dto): JsonResponse
    {
        if (Auth::attempt($dto->only('email', 'password')->all())) {
            /** @var User $user */
            $user = Auth::user();
            throw_if(!$user, 'RuntimeException', 'User not found');

            $scope = $dto->scope;

            if ($this->userIsInfluencer->handle($scope, $user)) {
                return (new ErrorResource([
                    'message' => 'Access denied!',
                ]))
                    ->response()
                    ->setStatusCode(Response::HTTP_FORBIDDEN);
            }

            $token = $this->createToken->handle($user, $scope);

            return (new TokenResource([
                'token' => $token,
            ]))->response();
        }

        return (new ErrorResource([
            'message' => 'Invalid Credentials!',
        ]))
            ->response()
            ->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function revokeToken(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $revoke = $user->token()?->revoke();

        return response()->json(['result' => $revoke]);
    }

    public function createRegister(RegisterData|DataObject $dto): JsonResponse
    {
        $dto->additional([
            'password' => Hash::make($dto->password),
            'is_influencer' => 1
        ]);

        $user = $this->userRepository->create($dto);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
