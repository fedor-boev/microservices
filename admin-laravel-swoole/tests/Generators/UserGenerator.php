<?php

namespace Tests\Generators;

use App\Enums\UserRole;
use App\Models\User;

class UserGenerator
{
    public static function generateUser()
    {
        // функционал фейкера
//        return [
//            'name' => $this->facker->
//        ];
    }

    public function createAdminUser(array $data = [])
    {
        return $this->createUser(array_merge($data, [
            'role_id' => UserRole::ADMIN
        ]));
    }

    public function createUser(array $data = [])
    {
        return User::factory()->create($data);
    }
}
