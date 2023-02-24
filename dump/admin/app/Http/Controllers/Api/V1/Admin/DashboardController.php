<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function chart(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        Gate::authorize('view', 'orders');

        $orders = Order::query()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity*order_items.price) as sum")
            ->groupBy('date')
            ->get();

        return ChartResource::collection($orders);
    }
}
