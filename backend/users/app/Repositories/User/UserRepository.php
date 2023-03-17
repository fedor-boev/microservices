<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Data\Requests\Auth\PasswordData;
use App\Data\Requests\Auth\RegisterData;
use App\Data\Requests\Auth\UserInfoData;
use App\Models\User\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Contracts\DataObject;

class UserRepository
{
    public function findByEmail(DataObject|RegisterData $dto): Model|User|null
    {
        return User::where('email', $dto->email)->first();
    }

    public function create(DataObject|RegisterData $dto): Model|User
    {
        return User::create($dto->all());
    }

    public function update(User|Authenticatable $user, DataObject|UserInfoData $getData): void
    {
        $user->update($getData->all());
    }
}
