<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\ChartResource;
use App\Models\Order\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Microservices\UserService;

// TODO export to actions or services
class DashboardController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Chart by orders
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function chart(): AnonymousResourceCollection
    {
        $this->userService->allows('view', 'orders');

        $orders = Order::query()
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity*order_items.price) as sum")
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('date')
            ->get();

        return ChartResource::collection($orders);
    }
}
