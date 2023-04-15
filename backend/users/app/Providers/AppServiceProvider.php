<?php

declare(strict_types=1);

namespace App\Providers;

use App\Modules\Auth\Repositories\AuthRepository;
use App\Modules\Auth\Services\AuthService;
use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Services\UserService;
use iAuthRepository;
use iAuthService;
use Illuminate\Support\ServiceProvider;
use User\iUserRepository;
use User\iUserService;

class AppServiceProvider extends ServiceProvider
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
        $this->bindClasses();
    }

    /**
     * @return void
     */
    private function bindClasses(): void
    {
        $this->app->bind(iAuthService::class, AuthService::class);
        $this->app->bind(iAuthRepository::class, AuthRepository::class);

        $this->app->bind(iUserService::class, UserService::class);
        $this->app->bind(iUserRepository::class, UserRepository::class);
    }
}
