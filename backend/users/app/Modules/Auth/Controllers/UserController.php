<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Modules\User\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{
    /**
     * Show AUTH user
     *
     * @throws Throwable
     */
    public function user(): JsonResponse
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        return (new UserResource($user))->response();
    }
}
