<?php

namespace App\Services\Auth;

use App\Contracts\Services\Auth\iAuthService;
use App\Data\Requests\Auth\LoginData;
use App\Data\Requests\Auth\PasswordData;
use App\Data\Requests\Auth\RegisterData;
use App\Data\Requests\Auth\UserInfoData;
use App\Http\Resources\Auth\TokenResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\Auth\Handlers\Password\HashPasswordHandler;
use App\Services\Auth\Handlers\Permissions\UserIsInfluencerHandler;
use App\Services\Auth\Handlers\Token\CreateTokenHandler;
use App\Services\Auth\Handlers\Token\RevokeTokenHandler;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Contracts\DataObject;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements iAuthService
{
    public function __construct(
        private readonly UserIsInfluencerHandler $userIsInfluencerHandler,
        private readonly CreateTokenHandler      $createTokenHandler,
        private readonly RevokeTokenHandler      $revokeTokenHandler,
        private readonly HashPasswordHandler     $hashPasswordHandler,
        //
        private readonly UserRepository          $userRepository
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

            if ($this->userIsInfluencerHandler->handle($scope, $user)) {
                return (new ErrorResource([
                    'message' => 'Access denied!',
                ]))
                    ->response()
                    ->setStatusCode(Response::HTTP_FORBIDDEN);
            }

            $token = $this->createTokenHandler->handle($user, $scope);

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

    /**
     * @inheritDoc
     */
    public function revokeToken(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $revoke = $this->revokeTokenHandler->handle($user);

        return response()->json(['result' => $revoke]);
    }

    /**
     * @inheritDoc
     */
    public function createRegister(RegisterData|DataObject $dto): JsonResponse
    {
        $dto->additional([
            'password' => Hash::make($dto->password),
            'is_influencer' => 1
        ]);

        $exist = $this->userRepository->findByEmail($dto);

        if ($exist) {
            return (new ErrorResource([
                'message' => 'user already exists'
            ]))->response()->setStatusCode(Response::HTTP_CONFLICT);
        }
        $user = $this->userRepository->create($dto);

        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @inheritDoc
     */
    public function updatePassword(Authenticatable|User $user, PasswordData|DataObject $getData): void
    {
        $getData->password = $this->hashPasswordHandler->handle(Hash::make($getData->password));

        $this->userRepository->update($user, $getData);
    }

    /**
     * @inheritDoc
     */
    public function updateUserInfo(Authenticatable|User $user, UserInfoData|DataObject $getData): void
    {
        $this->userRepository->update($user, $getData);
    }
}
