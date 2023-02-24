<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Microservices\UserService;

class AuthController extends Controller
{
    /**
     * Get User
     *
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource((new UserService)->getUser());
    }
}
