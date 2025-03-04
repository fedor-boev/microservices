<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Jobs\LinkCreated;
use App\Models\Link;
use App\Models\LinkProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Microservices\UserService;

class LinkController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return LinkResource
     */
    public function store(Request $request)
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
