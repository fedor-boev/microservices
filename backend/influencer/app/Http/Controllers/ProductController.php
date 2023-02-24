<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $products = \Cache::remember('products', 60 * 30, function () use ($request) {
            return Product::all();
        });

        if ($s = $request->input('s')) {
            $products = $products->filter(function (Product $product) use ($s) {
                return Str::contains($product->title, $s) || Str::contains($product->description, $s);
            });
        }

        return ProductResource::collection($products);
    }
}
