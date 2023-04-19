<?php

namespace App\Modules\Auth\Services\UseCases\Password;

use Illuminate\Support\Facades\Hash;

class HashPassword
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
