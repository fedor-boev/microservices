<?php

declare(strict_types=1);

namespace App\Common\Contracts\User;

interface iUserRepository
{
    public function getAll();
    public function getById(int $id);

    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function delete(int $id);
}
