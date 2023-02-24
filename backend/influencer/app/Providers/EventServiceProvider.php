<?php

declare(strict_types=1);

namespace App\Providers;

use App\Jobs\LinkCreated;
use App\Jobs\OrderCompleted;
use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        \App::bindMethod(ProductCreated::class . '@handle', static fn($job) => $job->handle());
        \App::bindMethod(ProductUpdated::class . '@handle', static fn($job) => $job->handle());
        \App::bindMethod(ProductDeleted::class . '@handle', static fn($job) => $job->handle());
        \App::bindMethod(LinkCreated::class . '@handle', static fn($job) => $job->handle());
        \App::bindMethod(OrderCompleted::class . '@handle', static fn($job) => $job->handle());
    }
}
