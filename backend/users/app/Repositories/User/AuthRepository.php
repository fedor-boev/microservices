<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Contracts\Repositories\Auth\iAuthRepository;
use App\Data\Requests\Auth\RegisterData;
use App\Data\Requests\Auth\UserInfoData;
use App\Models\User\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;

class AuthRepository implements iAuthRepository
{
    /**
     * @inheritdoc
     */
    public function findByEmail(DataObject|RegisterData $dto): Model|User|null
    {
        return User::where('email', $dto->email)->first();
    }

    /**
     * @inheritdoc
     */
    public function create(DataObject|RegisterData $dto): Model|User
    {
        return User::create($dto->all());
    }

    /**
     * @inheritdoc
     */
    public function update(User|Authenticatable $user, DataObject|UserInfoData $getData): void
    {
        $user->update($getData->all());
    }
}
