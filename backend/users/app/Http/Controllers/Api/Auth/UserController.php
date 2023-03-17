<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show AUTH user
     *
     * @throws \Throwable
     */
    public function user(): JsonResponse
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        return (new UserResource($user))->response();
    }
}
