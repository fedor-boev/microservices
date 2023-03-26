<?php

declare(strict_types=1);

namespace App\Modules\User\DTO;

use App\Modules\Auth\DTO\LoginData;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
//        public string $email,
//        public string $password,
//        public string $scope,
    ) {}

    /**
     * @param array $data
     * @return UserData
     */
    public static function fromArray(array $data): UserData
    {
        return new self(
//            email: $data['email'],
//            password: $data['password'],
//            scope: $data['scope']
        );
    }
}
