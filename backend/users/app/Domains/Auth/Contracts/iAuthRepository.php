<?php

declare(strict_types=1);

namespace App\Domains\Auth\Contracts;

use App\Domains\User\Models\User;
use App\Domains\Auth\DTO\Requests\RegisterData;
use App\Domains\Auth\DTO\Requests\UserInfoData;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;

interface iAuthRepository
{
    /**
     * Find User by email
     *
     * @param DataObject|RegisterData $dto
     * @return Model|User|null
     */
    public function findByEmail(DataObject|RegisterData $dto): Model|User|null;

    /**
     * Register new user
     *
     * @param DataObject|RegisterData $dto
     * @return Model|User
     */
    public function create(DataObject|RegisterData $dto): Model|User;

    /**
     * Update auth user
     *
     * @param User|Authenticatable $user
     * @param DataObject|UserInfoData $getData
     * @return void
     */
    public function update(User|Authenticatable $user, DataObject|UserInfoData $getData): void;
}
