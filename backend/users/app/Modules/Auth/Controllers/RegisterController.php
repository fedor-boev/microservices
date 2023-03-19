<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Contracts\iAuthService;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class RegisterController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService,
    )
    {

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
}
