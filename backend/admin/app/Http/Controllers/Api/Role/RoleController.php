<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Microservices\UserService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource api
 */
class RoleController extends Controller
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
     * Get all roles
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->userService->allows('view', 'roles');

        return RoleResource::collection(Role::all());
    }

    /**
     * Store new role and chain to permission
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->userService->allows('edit', 'roles');

        $role = Role::create($request->only('name'));

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response()->json(new RoleResource($role), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return RoleResource
     * @throws AuthorizationException
     */
    public function show($id): RoleResource
    {
        $this->userService->allows('view', 'roles');

        return new RoleResource(Role::find($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->userService->allows('edit', 'roles');

        $role = Role::find($id);

        $role->update($request->only('name'));

        DB::table('role_permission')->where('role_id', $role->id)->delete();

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response()->json(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy($id): JsonResponse
    {
        $this->userService->allows('edit', 'roles');

        DB::table('role_permission')->where('role_id', $id)->delete();

        Role::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
