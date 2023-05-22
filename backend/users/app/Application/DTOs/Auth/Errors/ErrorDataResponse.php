<?php

namespace App\Application\DTOs\Auth\Errors;

use Spatie\LaravelData\Data;

class ErrorDataResponse extends Data
{
    public function __construct(
        public string $message
    )
    {
    }
}
