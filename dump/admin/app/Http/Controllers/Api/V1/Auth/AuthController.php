<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     *   path="/login",
     *   tags={"Public"},
     *   @OA\Response(response="200",
     *     description="Login",
     *   )
     * )
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error' => 'Invalid Credentials!',
                ], Response::HTTP_UNAUTHORIZED);
            }

            $token = $user->createToken('admin')->accessToken;

            cookie('jwt', $token, 3600);

            return response()->json(['token' => $token])->withCookie('jwt');
        }

        return response()->json([
            'error' => 'Invalid Credentials!',
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @OA\Post(
     *   path="/register",
     *   tags={"Public"},
     *   @OA\Response(response="200",
     *     description="Register",
     *   )
     * )
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + [
                'password' => Hash::make($request->input('password')),
                // TODO: Enum
                'role_id' => 1,
                'is_influencer' => 1
            ]
        );

        return response()->json($user, Response::HTTP_CREATED);
    }

    // TODO: add logout

    /**
     * @OA\Get(path="/user",
     *   security={{"bearerAuth":{}}},
     *   tags={"Profile"},
     *   @OA\Response(response="200",
     *     description="Authenticated User",
     *   )
     * )
     * @throws \Throwable
     */
    public function user(): UserResource
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $resource = new UserResource($user);

        /** @var User $user */
        if ($user->isInfluencer()) {
            return $resource;
        }

        return $resource->additional([
            'data' => [
                'permissions' => $user->permissions(),
            ],
        ]);
    }

    /**
     * @OA\Put(
     *   path="/info",
     *   security={{"bearerAuth":{}}},
     *   tags={"Profile"},
     *   @OA\Response(response="202",
     *     description="User Info Update",
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UpdateInfoRequest")
     *   )
     * )
     * @throws \Throwable
     */
    public function updateInfo(UpdateInfoRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response()->json(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Put(
     *   path="/password",
     *   security={{"bearerAuth":{}}},
     *   tags={"Profile"},
     *   @OA\Response(response="202",
     *     description="User Password Update",
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UpdatePasswordRequest")
     *   )
     * )
     * @throws \Throwable
     */
    public function updatePassword(UpdatePasswordRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }
}
