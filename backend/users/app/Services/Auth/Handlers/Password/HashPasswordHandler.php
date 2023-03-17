<?php

namespace App\Services\Auth\Handlers\Password;

use Illuminate\Support\Facades\Hash;

class HashPasswordHandler
{
    /**
     * Create password hash
     *
     * @param string $password
     * @return string
     */
    public function handle(string $password): string
    {
        return Hash::make($password);
    }
}
