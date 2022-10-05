<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class OrderController extends AdminController
{
    /**
     * @OA\Get(path="/orders",
     *   security={{"bearerAuth":{}}},
     *   tags={"Orders"},
     *   @OA\Response(response="200",
     *     description="Order Collection",
     *   )
     * )
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        Gate::authorize('view', 'orders');

        $order = Order::paginate();

        return OrderResource::collection($order);
    }

    /**
     * @OA\Get(path="/orders/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Orders"},
     *   @OA\Response(response="200",
     *     description="User",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="Order ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     * @throws AuthorizationException
     */
    public function show($id): OrderResource
    {
        \Gate::authorize('view', 'orders');

        return new OrderResource(Order::find($id));
    }

    /**
     * @OA\Get(path="/export",
     *   security={{"bearerAuth":{}}},
     *   tags={"Orders"},
     *   @OA\Response(response="200",
     *     description="Order Export",
     *   )
     * )
     * @throws AuthorizationException
     */
    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        \Gate::authorize('view', 'orders');

// Если Вы будет вставлять этот код в начало каждого PHP файла, то он не будет кешироваться.
//        Response.ClearHeaders();
//        Response.AppendHeader("Cache-Control", "no-cache"); //HTTP 1.1
//        Response.AppendHeader("Cache-Control", "private"); // HTTP 1.1
//        Response.AppendHeader("Cache-Control", "no-store"); // HTTP 1.1
//        Response.AppendHeader("Cache-Control", "must-revalidate"); // HTTP 1.1
//        Response.AppendHeader("Cache-Control", "max-stale=0"); // HTTP 1.1
//        Response.AppendHeader("Cache-Control", "post-check=0"); // HTTP 1.1
//        Response.AppendHeader("Cache-Control", "pre-check=0"); // HTTP 1.1
//        Response.AppendHeader("Pragma", "no-cache"); // HTTP 1.0
//        Response.AppendHeader("Expires", "Mon, 26 Jul 1997 05:00:00 GMT"); // HTTP 1.0

        $headers = [
            "Content-type" => "text/csv",
            // предупредить пользователя о необходимости сохранить пересылаемые данные, такие как сгенерированный файл
            "Content-Disposition" => "attachment; filename=orders.csv",
            // То же, что и Cache-Control: no-cache. Заставляет кеши отправлять запрос на исходный сервер для проверки перед выпуском кешированной копии.
            "Pragma" => "no-cache",
            // must revalidate - Кеш должен проверить статус устаревших ресурсов перед их использованием. Просроченные ресурсы не должны быть использованы.
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = static function () {
            $orders = Order::all();
            $file = fopen('php://output', 'w');

            //Header Row
            fputcsv($file, ['ID', 'Name', 'Email', 'Order Title', 'Price', 'Quantity']);

            //Body
            foreach ($orders as $order) {
                fputcsv($file, [$order->id, $order->name, $order->email, '', '', '']);

                foreach ($order->orderItems as $orderItem) {
                    fputcsv($file, ['', '', '', $orderItem->product_title, $orderItem->price, $orderItem->quantity]);
                }
            }

            fclose($file);
        };

        return \Response::stream($callback, 200, $headers);
    }
}
