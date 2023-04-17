<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\DTO\LoginData;
use App\Modules\Auth\DTO\PasswordData;
use App\Modules\Auth\DTO\RegisterData;
use App\Modules\Auth\DTO\UserInfoData;
use App\Modules\Auth\Resources\TokenResource;
use App\Modules\Auth\Services\UseCases\Password\HashPassword;
use App\Modules\Auth\Services\UseCases\Permissions\UserIsInfluencer;
use App\Modules\Auth\Services\UseCases\Token\CreateToken;
use App\Modules\Auth\Services\UseCases\Token\RevokeToken;
use App\Modules\User\Models\User;
use App\Modules\User\Resources\UserResource;
use ErrorResource;
use iAuthRepository;
use iAuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Contracts\DataObject;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements iAuthService
{
    public function __construct(
        private readonly UserIsInfluencer $userIsInfluencer,
        private readonly CreateToken      $createToken,
        private readonly RevokeToken      $revokeToken,
        private readonly HashPassword     $hashPassword,
        //
        private readonly iAuthRepository $userRepository
    )
    {

    }

    /**
     * @inheritDoc
     * @throws \Throwable
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

    /**
     * @inheritDoc
     */
    public function revokeToken(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $revoke = $this->revokeToken->handle($user);

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
        $getData->password = $this->hashPassword->handle(Hash::make($getData->password));

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
