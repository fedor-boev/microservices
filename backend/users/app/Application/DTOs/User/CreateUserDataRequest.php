<?php

declare(strict_types=1);

namespace App\Application\DTOs\User;

use Spatie\LaravelData\Data;

class CreateUserDataRequest extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
    )
    {
    }
}
