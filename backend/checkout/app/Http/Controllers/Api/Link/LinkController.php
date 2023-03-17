<?php

declare(strict_types=1);

namespace Link;

use App\Http\Controllers\Controller;
use App\Http\Resources\Link\LinkResource;
use App\Models\Link\Link;

class LinkController extends Controller
{
    public function show($code)
    {
        $link = Link::where('code', $code)->first();

        return new LinkResource($link);
    }
}
