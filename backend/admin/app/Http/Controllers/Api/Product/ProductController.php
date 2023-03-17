<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Jobs\Product\ProductCreated;
use App\Jobs\Product\ProductDeleted;
use App\Jobs\Product\ProductUpdated;
use App\Models\Product\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Microservices\UserService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource api
 */
class ProductController extends Controller
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
     * Get all products
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->userService->allows('view', 'products');

        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    /**
     * SHOW
     *
     * @throws AuthorizationException
     */
    public function show($id): ProductResource
    {
        $this->userService->allows('view', 'products');

        return new ProductResource(Product::find($id));
    }

    /**
     * STORE
     *
     * @throws AuthorizationException
     */
    public function store(ProductCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userService->allows('edit', 'products');

        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        ProductCreated::dispatch($product->toArray())->onQueue('checkout_queue');
        ProductCreated::dispatch($product->toArray())->onQueue('influencer_queue');

        return response()->json($product, Response::HTTP_CREATED);
    }

    /**
     * UPDATE
     *
     * @throws AuthorizationException
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $this->userService->allows('edit', 'products');

        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        ProductUpdated::dispatch($product->toArray())->onQueue('checkout_queue');
        ProductUpdated::dispatch($product->toArray())->onQueue('influencer_queue');

        return response()->json($product, Response::HTTP_ACCEPTED);
    }

    /**
     * DESTROY
     *
     * @throws AuthorizationException
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->userService->allows('edit', 'products');

        Product::destroy($id);

        ProductDeleted::dispatch($id)->onQueue('checkout_queue');
        ProductDeleted::dispatch($id)->onQueue('influencer_queue');

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
