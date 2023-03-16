<?php

declare(strict_types=1);


use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Contracts\DataObject;
interface iUserRepository
{
    /**
     * Check user's credentials
     * and returns access token
     * with user's data
     *
     * @param DataObject $dto
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(DataObject $dto): JsonResponse;
}
