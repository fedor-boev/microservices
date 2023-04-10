<?php

declare(strict_types=1);

namespace App\Modules\User\Providers;

use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Services\UserService;
use Illuminate\Support\ServiceProvider;
use User\iUserRepository;
use User\iUserService;

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
        $this->bindClasses();
    }

    /**
     * @return void
     */
    private function bindClasses(): void
    {
        $this->app->bind(iUserService::class, UserService::class);
        $this->app->bind(iUserRepository::class, UserRepository::class);
    }
}
