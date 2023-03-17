<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\Auth\iAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class LoginController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService,
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
}
