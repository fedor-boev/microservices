<?php

declare(strict_types=1);


use App\Http\Resources\User\UserResource;
use Microservices\UserService;

class AuthController extends \App\Http\Controllers\Controller
{
    /**
     * Auth by user service
     *
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource((new UserService)->getUser());
    }
}
