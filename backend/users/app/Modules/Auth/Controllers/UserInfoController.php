<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Requests\InfoRequest;
use App\Modules\User\Models\User;
use App\Modules\User\Resources\UserResource;
use Controller;
use iAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserInfoController extends Controller
{
    public function __construct(
        private readonly iAuthService $authService
    )
    {

    }

    /**
     * @throws InvalidDataClass
     * @throws Throwable
     */
    public function updateInfo(InfoRequest $request): JsonResponse
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
