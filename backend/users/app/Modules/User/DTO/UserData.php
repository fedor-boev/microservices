<?php

declare(strict_types=1);

namespace App\Modules\User\DTO;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
//        public string $email,
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
//            scope: $data['scope']
        );
    }
}
