<?php

namespace Modules\products\Events;

use Modules\products\Repository\ProductRepositoryInterface;

class UpdateProductInventory
{
    public function handle($data): void
    {
        $productId = $data['productId'];
        $kind = $data['kind'];
        $count = $data['count'];

        $product = app(ProductRepositoryInterface::class)->find($productId);

        match ($kind) {
            'increase' => $product->lockForUpdate()->update(['inventory' => bcadd($product->inventory, $count)]),
            'decrease' => $product->lockForUpdate()->update(['inventory' => bcsub($product->inventory, $count)])
        };
    }
}
