<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\Auth\iAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
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
