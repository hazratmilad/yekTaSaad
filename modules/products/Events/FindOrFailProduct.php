<?php

namespace Modules\products\Events;

use Modules\products\Repository\ProductRepositoryInterface;

class FindOrFailProduct
{
    public function handle($productId)
    {
        return app(ProductRepositoryInterface::class)->find($productId);
    }
}
