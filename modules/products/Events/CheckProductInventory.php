<?php

namespace Modules\products\Events;

use Modules\products\Repository\ProductRepositoryInterface;

class CheckProductInventory
{
    public function handle($data): bool
    {
        $productId = $data['productId'];
        $productCount = $data['productCount'];

        $product = app(ProductRepositoryInterface::class)->find($productId);

        return bccomp($product->inventory, 0) == 1 && bccomp($product->inventory, $productCount) == 1;
    }
}
