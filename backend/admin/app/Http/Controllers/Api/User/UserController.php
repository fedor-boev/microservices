<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\UserRole;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Microservices\UserService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource api
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all users
     *
     * @param Request $request
     * @return array
     * @throws AuthorizationException
     */
    public function index(Request $request): array
    {
        $this->userService->allows('view', 'users');

        return $this->userService->paginate($request->input('page', 1));
    }

    /**
     * Show user
     *
     * @throws AuthorizationException
     */
    public function show($id): UserResource
    {
        $this->userService->allows('view', "users");

        $user = $this->userService->find($id);

        return new UserResource($user);
    }

    /**
     * Store new user
     *
     * @throws AuthorizationException
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $this->userService->allows('edit', "users");

        $data = $request->only('first_name', 'last_name', 'email') + ['password' => 1234];

        $user = $this->userService->create($data);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->input('role_id'),
        ]);

//        AdminAdded::dispatch($user->email);

        return response()->json(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Update user
     *
     * @throws AuthorizationException
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $this->userService->allows('edit', "users");

        $user = $this->userService->update($id, $request->only('first_name', 'last_name', 'email'));

        UserRole::where('user_id', $user->id)->delete();

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->input('role_id'),
        ]);

        return response()->json(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    /**
     * delete user
     *
     * @throws AuthorizationException
     */
    public function destroy($id): JsonResponse
    {
        $this->userService->allows('edit', "users");

        $this->userService->delete($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
