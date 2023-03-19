<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Contracts\iAuthService;
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
