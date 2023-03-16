<?php

declare(strict_types=1);

namespace App\Jobs\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminAdded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $email)
    {
        //
    }

    public function handle()
    {
//        \Mail::send('admin.adminAdded', [], function (Message $message) {
//            $message->to($this->email);
//            $message->subject('You have been added to the Admin App!');
//        });

// V2 =============

//        var_dump('sending emails');
//
//        \Mail::send('admin', ['order' => $this->data], function (Message $message) {
//            $message->subject('An Order has been completed');
//            $message->to('admin@admin.com');
//        });
//
//        \Mail::send('ambassador', ['order' => $this->data], function (Message $message) {
//            $message->subject('An Order has been completed');
//            $message->to($this->data['ambassador_email']);
//        });
//
//        var_dump('Email sent');
    }
}
