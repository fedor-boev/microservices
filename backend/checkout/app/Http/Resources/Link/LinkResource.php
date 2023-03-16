<?php

declare(strict_types=1);

namespace App\Http\Resources\Link;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'user' => ['id' => 45, 'first_name' => 'Influencer', 'last_name' => 'Influencer'],//(new UserService())->get($this->user_id),
            'products' => ProductResource::collection($this->products),
        ];
    }
}
