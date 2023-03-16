<?php
///** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateInfoRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    // TODO: настроить интерфейсы
    public function __construct(
        private AuthService $authService,
        private UserService $userService
    )
    {

    }

    /**
     * Get influencer token
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws InvalidDataClass
     * @throws \Throwable
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->createToken($request->getData());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->authService->revokeToken();
    }

    /**
     * Register new user, where user is influencer
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws InvalidDataClass
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->authService->createRegister($request->getData());
    }

    /**
     * Show AUTH user
     *
     * @throws \Throwable
     */
    public function user(): JsonResponse
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        return (new UserResource($user))
            ->response();
    }

    /**
     * Update auth user
     *
     * @param UpdateInfoRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function updateInfo(UpdateInfoRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update($request->only('first_name', 'last_name', 'email'));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    /**
     * Update AUTH user password
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Check AUTH user is authenticated
     *
     * @return int
     */
    public function authenticated(): int
    {
        return 1;
    }
}
