<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginatedResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * INDEX Users
     *
     * @param Request $request
     * @return Collection|AnonymousResourceCollection
     */
    public function index(Request $request): Collection|AnonymousResourceCollection
    {
        if ((int)$request->input('page') === -1) {
            return User::all();
        }

        return PaginatedResource::collection(User::paginate());
    }

    /**
     * TODO: resource
     * SHOW user
     *
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        return User::find($id)?->toArray ?? [];
    }

    /**
     * Store user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only('first_name', 'last_name', 'email')
            + ['password' => Hash::make($request->input('password'))];

        $user = User::create($data);

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Update user
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

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
        return (bool) User::destroy($id);
    }
}
