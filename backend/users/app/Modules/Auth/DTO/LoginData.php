<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public string $scope,
    ) {}

    /**
     * @param array $data
     * @return LoginData
     */
    public static function fromArray(array $data): LoginData
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
            scope: $data['scope']
        );
    }
}
