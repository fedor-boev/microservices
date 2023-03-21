<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Common\Contracts\User\iUserService;
use App\Common\Controllers\Controller;
use App\Modules\Auth\Requests\PasswordRequest;
use App\Modules\User\Models\User;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdatePasswordController extends Controller
{
    public function __construct(
        private readonly iUserService $authService
    )
    {

    }


    /**
     * Update AUTH user password
     *
     * @param PasswordRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function updatePassword(PasswordRequest $request): JsonResponse
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
