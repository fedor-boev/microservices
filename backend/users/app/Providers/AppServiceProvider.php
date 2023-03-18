<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Auth\AuthService;
use App\Domains\Auth\Contracts\iAuthRepository;
use App\Domains\Auth\Contracts\iAuthService;
use App\Domains\Auth\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;

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
    }
}
