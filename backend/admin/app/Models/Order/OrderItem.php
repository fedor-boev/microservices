<?php

declare(strict_types=1);

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property string $product_title
 * @property string $price
 * @property int $quantity
 * @property string $revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order\OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
