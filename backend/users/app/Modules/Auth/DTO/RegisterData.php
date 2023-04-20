<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RegisterData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public int|Optional $is_influencer,
    ) {}
}
