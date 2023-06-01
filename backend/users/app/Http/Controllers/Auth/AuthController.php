<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Get influencer token
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            throw_if(!$user, 'RuntimeException', 'User not found');

            $scope = $request->input('scope');

            if ($scope !== 'influencer' && $user->isInfluencer()) {
                return response()->json([
                    'error' => 'Access denied!',
                ], Response::HTTP_FORBIDDEN);
            }

            $token = $user->createToken($scope, [$scope])->accessToken;

            return response()->json([
                'token' => $token,
            ]);
        }

        return response()->json([
            'error' => 'Invalid Credentials!',
        ], Response::HTTP_UNAUTHORIZED);
    }


    /**
     * Register new user, where user is influencer
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + [
                'password' => Hash::make($request->input('password')),
                'is_influencer' => 1,
            ]
        );

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Show AUTH user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     * @throws \Throwable
     */
    public function user(): \Illuminate\Contracts\Auth\Authenticatable
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        return $user;
    }

//    /**
//     * Update auth user
//     *
//     * @param UpdateInfoRequest $request
//     * @return JsonResponse
//     * @throws \Throwable
//     */
//    public function updateInfo(UpdateInfoRequest $request): JsonResponse
//    {
//        /** @var User $user */
//        $user = Auth::user();
//
//        throw_if(!$user, 'RuntimeException', 'User not found');
//
//        $user->update($request->only('first_name', 'last_name', 'email'));
//
//        return response()->json($user, Response::HTTP_ACCEPTED);
//    }


//    /**
//     * Update AUTH user password
//     *
//     * @param UpdatePasswordRequest $request
//     * @return JsonResponse
//     * @throws \Throwable
//     */
//    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
//    {
//        /** @var User $user */
//        $user = Auth::user();
//
//        throw_if(!$user, 'RuntimeException', 'User not found');
//
//        $user->update([
//            'password' => Hash::make($request->input('password')),
//        ]);
//
//        return response()->json($user, Response::HTTP_ACCEPTED);
//    }

    /**
     * User is authenticated
     *
     * @return int
     */
    public function authenticated(): int
    {
        return 1;
    }
}
