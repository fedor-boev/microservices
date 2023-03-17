<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Microservices\UserService;

// TODO export actions or services
class AuthController extends Controller
{
    /**
     * Get User from user service
     *
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource((new UserService)->getUser());
    }
}
