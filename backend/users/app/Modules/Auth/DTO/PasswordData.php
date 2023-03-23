<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class PasswordData extends Data
{
    public function __construct(
        public string $password
    ) {}
}
