<?php

declare(strict_types=1);

namespace App\Application\DTOs\Auth\User;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateUserDataRequest extends Data
{
    public function __construct(
        public string          $first_name,
        public string          $last_name,
        public string          $email,
        public Optional|string $password,
        public Optional|int    $is_influencer,
    )
    {
    }
}
