<?php

declare(strict_types=1);

namespace App\Application\DTOs\Auth;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RegisterDataRequest extends Data
{
    public function __construct(
        public string       $first_name,
        public string       $last_name,
        public string       $email,
        public string       $password,
        public Optional|int $is_influencer,
    )
    {
    }
}
