<?php

namespace App\Repositories\User;

use App\Data\Requests\Auth\RegisterData;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;

class UserRepository
{
    public function create(RegisterData|DataObject $dto): Model|User
    {
        return User::create($dto->all());
    }
}
