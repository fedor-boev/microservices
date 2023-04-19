<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\User\Controller;

use App\Modules\User\Requests\IndexRequest;
use App\Modules\User\Requests\StoreRequest;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\UserService;
use Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {

    }

    /**
     * Get users
     *
     * @param IndexRequest $request
     * @return Collection|AnonymousResourceCollection
     */
    public function index(IndexRequest $request): Collection|AnonymousResourceCollection
    {
        if ((int)$request->input('page') === -1) {
            return $this->userService->getAll();
        }

        return UserResource::collection($this->userService->paginate());
    }

    /**
     * Show user
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return (new UserResource($this->userService->getById($id)))->response();
    }

    /**
     * Store user
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->only('first_name', 'last_name', 'email')
            + ['password' => Hash::make($request->input('password'))];

        $user = $this->userService->create($data);

        return (new UserResource($user))->response(Response::HTTP_CREATED);
    }

    /**
     * Update user
     * TODO: resource, validate
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = $this->userService->getById($id);

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove user by user_id
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return (bool) $this->userService->delete($id);
    }
}
