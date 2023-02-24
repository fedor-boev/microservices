<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * Get auth user token
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
     * Register new user
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

    public function user()
    {
        return \Auth::user();
    }

    /**
     * Update auth user
     *
     * @param UpdateInfoRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = \Auth::user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }


    /**
     * Update auth user password
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = Auth::user();

        throw_if(!$user, 'RuntimeException', 'User not found');

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * @return int
     */
    public function authenticated(): int
    {
        return 1;
    }
}
