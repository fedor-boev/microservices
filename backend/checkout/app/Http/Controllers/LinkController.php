<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use Microservices\UserService;

class LinkController extends Controller
{
    public function show($code)
    {
        $link = Link::where('code', $code)->first();

        return new LinkResource($link);
    }
}
