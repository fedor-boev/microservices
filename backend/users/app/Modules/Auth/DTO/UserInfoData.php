<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class UserInfoData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email
    ) {}
}
