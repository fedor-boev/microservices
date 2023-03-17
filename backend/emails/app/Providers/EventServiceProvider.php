<?php

declare(strict_types=1);

namespace App\Providers;

use App\Jobs\Admin\AdminAdded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
//    /**
//     * The event to listener mappings for the application.
//     *
//     * @var array<class-string, array<int, class-string>>
//     */
//    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
//    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        \App::bindMethod(AdminAdded::class . '@handle', static fn($job) => $job->handle());
    }

//    /**
//     * Determine if events and listeners should be automatically discovered.
//     */
//    public function shouldDiscoverEvents(): bool
//    {
//        return false;
//    }
}
