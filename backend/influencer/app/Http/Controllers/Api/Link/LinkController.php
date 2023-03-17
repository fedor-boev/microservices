<?php

declare(strict_types=1);

namespace Link;

use App\Http\Controllers\Controller;
use App\Http\Resources\Link\LinkResource;
use App\Jobs\Link\LinkCreated;
use App\Models\Link\Link;
use App\Models\LinkProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Microservices\UserService;

class LinkController extends Controller
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
     * TODO validate
     * @param Request $request
     * @return LinkResource
     */
    public function store(Request $request): LinkResource
    {
        $user = $this->userService->getUser();

        $link = Link::create([
            'user_id' => $user->id,
            'code' => Str::random(6),
        ]);

        $linkProducts = [];

        foreach ($request->input('products') as $product_id) {
            $linkProduct = LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id,
            ]);

            $linkProducts[] = $linkProduct->toArray();
        }

        LinkCreated::dispatch($link->toArray(), $linkProducts)->onQueue('checkout_queue');

        return new LinkResource($link);
    }
}
