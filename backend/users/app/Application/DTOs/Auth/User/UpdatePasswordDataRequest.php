<?php

declare(strict_types=1);

namespace App\Application\DTOs\Auth\User;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdatePasswordDataRequest extends Data
{
    public function __construct(
        public string $password,
    )
    {
    }
}
