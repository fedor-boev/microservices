<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\PaginatedResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    // TODO
    public function index(Request $request): Collection|AnonymousResourceCollection
    {
        if (-1 === (int)$request->input('page')) {
            return User::all();
        }

        return PaginatedResource::collection(User::paginate());
    }

    // TODO
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Store new user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->only('first_name', 'last_name', 'email')
            + ['password' => \Hash::make($request->input('password'))];

        $user = User::create($data);

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Update user by user_id
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove user by user_id
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        User::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
