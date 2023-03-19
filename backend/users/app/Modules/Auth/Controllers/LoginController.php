<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Contracts\iAuthService;
use App\Modules\Auth\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Throwable;

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
     * @throws Throwable
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->createToken($request->getData());
    }
}
