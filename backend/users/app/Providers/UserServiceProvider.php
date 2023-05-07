<?php

declare(strict_types=1);

namespace App\Providers;

use App\Application\Contracts\Repositories\iUserRepository;
use App\Application\Contracts\Services\iUserService;
use App\Application\Contracts\UseCases\User\iUserUseCase;
use App\Application\Services\UserService;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->repositoriesBind();
        $this->servicesBind();
    }

    public function repositoriesBind(): void
    {
        $this->app->bind(iUserRepository::class, UserRepository::class);
    }

    public function servicesBind(): void
    {
        $this->app->bind(iUserService::class, UserService::class);
    }
}
