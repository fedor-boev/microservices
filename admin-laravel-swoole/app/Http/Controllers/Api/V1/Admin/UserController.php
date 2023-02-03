<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\Abilities;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AdminController
{
    /**
     * @OA\Get(path="/admin/users",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Response(response="200",
     *     description="User Collection",
     *   ),
     *   @OA\Parameter(
     *     name="page",
     *     description="Pagination page",
     *     in="query",
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize(Abilities::VIEW, 'users');

        $users = User::paginate();

        return UserResource::collection($users)->response();
    }

    /**
     * @OA\Get(path="/users/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Response(response="200",
     *     description="User",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="User ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     * @throws AuthorizationException
     */
    public function show($id): UserResource
    {
        Gate::authorize('view', 'users');

        $user = User::find($id);

        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *   path="/users",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Response(response="201",
     *     description="User Create",
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UserCreateRequest")
     *   )
     * )
     * @throws AuthorizationException
     */
    public function store(UserCreateRequest $request)
    {
        \Gate::authorize('edit', 'users');

        $user = User::create(
            $request->only('first_name', 'last_name', 'email', 'role_id')
            + ['password' => Hash::make(1234)]
        );

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *   path="/users/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Response(response="202",
     *     description="User Update",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="User ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *   )
     * )
     * @throws AuthorizationException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        \Gate::authorize('edit', 'users');

        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(path="/users/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Response(response="204",
     *     description="User Delete",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="User ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        \Gate::authorize('edit', 'users');

        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
