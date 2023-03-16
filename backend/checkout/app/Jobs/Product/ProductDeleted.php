<?php

declare(strict_types=1);

namespace App\Jobs\Product;

use App\Models\Product\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return void
     */
    public function handle()
    {
        Product::destroy($this->id);
    }
}
