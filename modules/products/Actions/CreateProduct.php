<?php

namespace Modules\products\Actions;

use Modules\core\Repositories\BaseRepositoryInterface;
use Modules\products\Http\Requests\ProductRequest;
use Modules\products\Repository\ProductRepositoryInterface;

class CreateProduct
{
    protected BaseRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductRequest $request)
    {
        return $this->repository->create($request->all());
    }
}
