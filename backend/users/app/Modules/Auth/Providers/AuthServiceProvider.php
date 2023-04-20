<?php

declare(strict_types=1);

namespace App\Modules\Auth\Providers;

use App\Modules\Auth\Repositories\AuthRepository;
use App\Modules\Auth\Services\AuthService;
use iAuthRepository;
use iAuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
    }
}
