<?php

declare(strict_types=1);

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $code
 * @property string|null $transaction_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $user_id
 * @property string $influencer_email
 * @property string|null $address
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $country
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read mixed $total
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order\OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereInfluencerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order\Order whereZip($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum(function (OrderItem $item) {
            return $item->revenue;
        });
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
