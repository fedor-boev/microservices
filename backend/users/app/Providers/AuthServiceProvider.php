<?php

declare(strict_types=1);

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Application\Contracts\Repositories\iAuthRepository;
use App\Application\Contracts\Services\iAuthService;
use App\Application\Contracts\UseCases\Auth\Password\iUpdatePassportUseCase;
use App\Application\Contracts\UseCases\Auth\Permission\iPermissionUseCase;
use App\Application\Contracts\UseCases\Auth\Token\iCreateTokenUseCase;
use App\Application\Contracts\UseCases\Auth\Token\iRevokeTokenUseCase;
use App\Application\Contracts\UseCases\Auth\User\iCreateNewUserUseCase;
use App\Application\Contracts\UseCases\Auth\User\iUpdateUserInfoUseCase;
use App\Application\Services\AuthService;
use App\Application\UseCases\Auth\Password\UpdatePasswordUseCase;
use App\Application\UseCases\Auth\Permission\PermissionUseCase;
use App\Application\UseCases\Auth\Token\CreateTokenUseCase;
use App\Application\UseCases\Auth\Token\RevokeTokenUseCase;
use App\Application\UseCases\Auth\User\CreateNewUserUseCase;
use App\Application\UseCases\Auth\User\UpdateUserInfoUseCase;
use App\Domain\Repositories\AuthRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::tokensCan([
            'admin' => 'Admin access',
            'influencer' => 'Influencer access'
        ]);

        $this->repositoriesBind();
        $this->servicesBind();
    }

    public function repositoriesBind(): void
    {
        $this->app->bind(iAuthRepository::class, AuthRepository::class);
    }

    public function servicesBind(): void
    {
        $this->app->bind(iAuthService::class, AuthService::class);
    }
}
