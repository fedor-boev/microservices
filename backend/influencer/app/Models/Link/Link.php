<?php

declare(strict_types=1);

namespace App\Models\Link;

use App\Models\LinkProduct;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Link
 *
 * @property int $id
 * @property string $code
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link\Link whereUserId($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, LinkProduct::class);
    }
}
