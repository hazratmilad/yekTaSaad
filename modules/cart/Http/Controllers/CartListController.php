<?php

namespace Modules\cart\Http\Controllers;

use Modules\cart\Actions\CartListTable;
use Modules\cart\Http\Resources\CartResource;
use Modules\core\Http\Controllers\CrudController;

class CartListController extends CrudController
{
    public function __invoke(CartListTable $carts)
    {
        $cart = $carts($this->user);
        return $this->success(CartResource::collection($cart));
    }
}
