<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

interface iUserService
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection;

    public function paginate(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function getById(int $id);

    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function delete(int $id): int;
}
