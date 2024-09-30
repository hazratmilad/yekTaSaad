<?php

namespace Modules\cart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\cart\Models\Cart;

/* @mixin Cart */
class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'price' => number_format($this->price),
            'count' => number_format($this->count),
            'product' => $this->product
        ];
    }
}
