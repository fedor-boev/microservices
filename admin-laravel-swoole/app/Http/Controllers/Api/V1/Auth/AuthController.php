<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
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
    public function login(Request $request)
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
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + [
                'password' => Hash::make($request->input('password')),
                'role_id' => 1,
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }

    // TODO: add logout
}
