<?php

declare(strict_types=1);

namespace App\Application\DTOs\User;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserDataResponse extends Data
{

    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public Optional|int $is_influencer;
    public string $created_at;
    public null|string $updated_at;
    public null|string $deleted_at;

}
