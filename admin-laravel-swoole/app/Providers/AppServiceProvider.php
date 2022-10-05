<?php

namespace App\Providers;

use App\Mail\JobFailedMailable;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Queue::failing(static function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception

            Mail::to('user@mail.local')->send(new JobFailedMailable($event));

            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID'),
                'text' => 'Failed job '. $event->exception->getMessage(). $event->job->getRawBody()
            ]);
        });

        Log::shareContext([
            'invocation-id' => (string) Str::uuid(),
        ]);
    }
}
