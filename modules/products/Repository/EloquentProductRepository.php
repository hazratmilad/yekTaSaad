<?php

namespace Modules\products\Repository;

use Modules\core\Repositories\EloquentBaseRepository;
use Modules\products\Models\Product;
use Throwable;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    protected string $model = 'Modules\products\Models\Product';

    /**
     * @throws Throwable
     */
    public function create(array $request): Product
    {
        $product = new Product($request);
        $product->saveOrFail();

        return $product;
    }

    public function getList(array $request)
    {
        $products = Product::query();
        $products->orderBy('id', 'DESC');

        if (array_key_exists('trashed', $request) && $request['trashed'] === 'true') {
            $products->onlyTrashed();
        }

        if (array_key_exists('title', $request) && !empty($request['title'])) {
            $products->where('title', 'like', '%' . $request['title'] . '%');
        }
        return $products->get();
    }

    public function update($id, array $request): Product
    {
        $product = $this->find($id);
        $product->lockForUpdate()->update($request);

        return $product->refresh();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }
}
