<?php

namespace Modules\cart\Http\Controllers;

use Modules\cart\Actions\AddProductToCartTable;
use Modules\cart\Http\Requests\AddToCartRequest;
use Modules\cart\Http\Resources\CartResource;
use Modules\core\Http\Controllers\CrudController;

class AddProductToCartController extends CrudController
{
    public function __invoke(AddToCartRequest $request, AddProductToCartTable $cartTable)
    {
        $cart = $cartTable($request, $this->user);
        if ($cart) {
            return $this->success(CartResource::collection($cart));
        }
        return $this->error(__('errors.product_unavailable'));
    }
}
