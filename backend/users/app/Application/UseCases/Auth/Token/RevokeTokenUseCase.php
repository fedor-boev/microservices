<?php

declare(strict_types=1);

namespace App\Application\UseCases\Auth\Token;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RevokeTokenUseCase
{
    /**
     * Revoke user token
     *
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $revoke = $user->token()?->revoke();

        return response()->json(['result' => $revoke], Response::HTTP_OK);
    }
}
