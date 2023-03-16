<?php

declare(strict_types=1);

namespace App\Contracts\Services\Auth;

use App\Data\Requests\Auth\LoginData;
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
}
