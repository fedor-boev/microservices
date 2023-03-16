<?php

declare(strict_types=1);

namespace App\Jobs\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public $orderData,
        public $orderItemsData
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        \Mail::send('influencer.admin', [
//            'id' => $this->orderData['id'],
//            'admin_total' => $this->orderData['admin_total']
//        ], function (Message $message) {
//            $message->to('admin@admin.com');
//            $message->subject('A new order has been completed!');
//        });
//
//        \Mail::send('influencer.influencer', [
//            'code' => $this->orderData['code'],
//            'influencer_total' => $this->orderData['influencer_total']
//        ], function (Message $message) {
//            $message->to($this->orderData['influencer_email']);
//            $message->subject('A new order has been completed!');
//        });
    }
}
