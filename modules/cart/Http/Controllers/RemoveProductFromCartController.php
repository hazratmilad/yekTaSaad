<?php

namespace Modules\cart\Http\Controllers;

use Modules\cart\Actions\RemoveProductFromCartTable;
use Modules\cart\Http\Requests\RemoveProductFromCartRequest;
use Modules\cart\Http\Resources\CartResource;
use Modules\core\Http\Controllers\CrudController;

class RemoveProductFromCartController extends CrudController
{
    public function __invoke(RemoveProductFromCartRequest $request, RemoveProductFromCartTable $cartTable)
    {
        $cart = $cartTable($request, $this->user);
        return $this->success(CartResource::collection($cart));
    }
}
