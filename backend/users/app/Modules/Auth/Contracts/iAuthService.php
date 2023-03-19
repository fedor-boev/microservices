<?php

declare(strict_types=1);

namespace App\Modules\Auth\Contracts;

use App\Modules\User\Models\User;
use App\Modules\Auth\DTO\Requests\LoginData;
use App\Modules\Auth\DTO\Requests\PasswordData;
use App\Modules\Auth\DTO\Requests\RegisterData;
use App\Modules\Auth\DTO\Requests\UserInfoData;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Contracts\DataObject;
use Throwable;

interface iAuthService
{
    /**
     * Check user's credentials
     * and returns access token
     * with user's data
     *
     * @param LoginData|DataObject $dto
     * @return JsonResponse
     * @throws Throwable
     */
    public function createToken(LoginData|DataObject $dto): JsonResponse;

    /**
     * Revoke access token user's data
     *
     * @return JsonResponse
     */
    public function revokeToken(): JsonResponse;

    /**
     * Register new user
     *
     * @param RegisterData|DataObject $dto
     * @return JsonResponse
     */
    public function createRegister(RegisterData|DataObject $dto): JsonResponse;

    /**
     * Update user password
     *
     * @param Authenticatable|User $user
     * @param PasswordData|DataObject $getData
     * @return void
     */
    public function updatePassword(Authenticatable|User $user, PasswordData|DataObject $getData): void;

    /**
     * Update user info
     *
     * @param Authenticatable|User $user
     * @param UserInfoData|DataObject $getData
     * @return void
     */
    public function updateUserInfo(Authenticatable|User $user, UserInfoData|DataObject $getData): void;
}
