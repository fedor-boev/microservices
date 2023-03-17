<?php

declare(strict_types=1);

namespace App\Data\Requests\Auth;

use Spatie\LaravelData\Data;

class PasswordData extends Data
{
    public function __construct(
        public string $password
    ) {}
}
