<?php

declare(strict_types=1);

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $image
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
}
