<?php

namespace Modules\products\Observers;

use Modules\products\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        runEvent('product.created', $product);
    }
}
