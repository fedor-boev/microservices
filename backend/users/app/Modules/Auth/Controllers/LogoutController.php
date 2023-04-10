<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Modules\Auth\Controllers;

use App\Common\Controllers\Controller;
use iAuthService;
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
