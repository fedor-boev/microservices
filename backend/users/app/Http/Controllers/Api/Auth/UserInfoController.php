<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\Auth\iAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateInfoRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Symfony\Component\HttpFoundation\Response;

class UserInfoController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService
    )
    {

    }

    /**
     * @throws InvalidDataClass
     * @throws \Throwable
     */
    public function updateInfo(UpdateInfoRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $this->authService->updateUserInfo($user, $request->getData());

        return (new UserResource($user->fresh()))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
