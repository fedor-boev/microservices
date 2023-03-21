<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Common\Contracts\User\iUserRepository;
use App\Modules\User\Models\User;

class UserRepository implements iUserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function paginate(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::paginate();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        return User::find($id)?->update($attributes);
    }

    public function delete($id): int
    {
        return User::destroy($id);
    }
}
