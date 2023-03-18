<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Contracts\iAuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService
    )
    {

    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->authService->revokeToken();
    }
}
