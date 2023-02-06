<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Influencer;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends InfluencerController
{
    public function index(Request $request)
    {
//        Gate::authorize('view', 'products');
//
        $query = Product::query();

        if ($s = $request->input('s')) {
            $query
                ->whereRaw("title ILIKE '%{$s}%'")
                ->orWhereRaw("description ILIKE '%{$s}%'");

        }

        return ProductResource::collection($query->get());
    }

//    public function show($id): ProductResource
//    {
//        Gate::authorize('view', 'products');
//
//        return new ProductResource(Product::find($id));
//    }
//
//    public function store(ProductCreateRequest $request)
//    {
//        Gate::authorize('edit', 'products');
//
//        $product = Product::create($request->only('title', 'description', 'image', 'price'));
//
//        return response($product, Response::HTTP_CREATED);
//    }
//
//    public function update(Request $request, $id)
//    {
//        \Gate::authorize('edit', 'products');
//
//        $product = Product::find($id);
//
//        $product->update($request->only('title', 'description', 'image', 'price'));
//
//        return response($product, Response::HTTP_ACCEPTED);
//    }
//
//    public function destroy($id)
//    {
//        \Gate::authorize('edit', 'products');
//
//        Product::destroy($id);
//
//        return response(null, Response::HTTP_NO_CONTENT);
//    }
}
