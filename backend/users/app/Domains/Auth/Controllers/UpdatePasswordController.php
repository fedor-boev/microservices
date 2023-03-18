<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Contracts\iAuthService;
use App\Domains\Auth\Requests\UpdatePasswordRequest;
use App\Domains\User\Models\User;
use App\Domains\User\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdatePasswordController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService
    )
    {

    }


    /**
     * Update AUTH user password
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $this->authService->updatePassword($user, $request->getData());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
