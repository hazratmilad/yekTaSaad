<?php

namespace Modules\products\Actions;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\core\Repositories\BaseRepositoryInterface;
use Modules\core\Utils\PaginationHelper;
use Modules\products\Repository\ProductRepositoryInterface;

class ProductList
{
    protected BaseRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): LengthAwarePaginator
    {
        $products = $this->repository->getList($request->all());
        $page_size = $request->get('page_size', 10);
        return PaginationHelper::paginate($products, $page_size);
    }
}
