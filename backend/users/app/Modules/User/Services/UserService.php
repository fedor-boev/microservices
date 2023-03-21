<?php

namespace App\Modules\User\Services;

use App\Common\Contracts\User\iUserService;
use App\Modules\User\Repositories\UserRepository;

class UserService implements iUserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {

    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function paginate(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->userRepository->paginate();
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function create(array $attributes)
    {
        return $this->userRepository->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        return $this->userRepository->update($id, $attributes);
    }

    public function delete($id): int
    {
        return $this->userRepository->delete($id);
    }
}
