<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO\Requests;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public string $scope,
    ) {}
}
