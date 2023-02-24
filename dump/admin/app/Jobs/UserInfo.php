<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class UserInfo implements ShouldQueue
{
    use Dispatchable, // dispatch
        InteractsWithQueue, // attempts
        Queueable, // onConnection, onQueue
        SerializesModels; //сериализация данных в контроллере


//    public $timeout = 1;

//    public $tries = 3;

    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        throw new \Exception('Failed');

        sleep(3);

        info('Hello!'. $this->user->id);

//        $this->user = $user;

//        Telegram::sendMessage([
//            'chat_id' => env('TELEGRAM_CHANNEL_ID'),
//            'text' => 'Start '. $user->id
//        ]);
//
//        sleep(5);
//
//        Telegram::sendMessage([
//            'chat_id' => env('TELEGRAM_CHANNEL_ID'),
//            'text' => 'End '. $user->id
//        ]);
    }

//    public function retryUntil(): \Illuminate\Support\Carbon
//    {
//        return now()->addMinute();
//    }

//    public function middleware(): array
//    {
//        return [(new WithoutOverlapping(1))->releaseAfter(50)];
//    }
}
