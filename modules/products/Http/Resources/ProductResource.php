<?php

namespace Modules\products\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\products\Models\Product;

/* @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'price' => number_format($this->price),
            'inventory' => number_format($this->inventory),
        ];
    }
}
