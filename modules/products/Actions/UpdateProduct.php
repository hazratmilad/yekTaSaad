<?php

namespace Modules\products\Actions;

use Modules\core\Repositories\BaseRepositoryInterface;
use Modules\products\Http\Requests\ProductRequest;
use Modules\products\Repository\ProductRepositoryInterface;

class UpdateProduct
{
    protected BaseRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductRequest $request, $id)
    {
        return $this->repository->update($id, $request->except('_method'));
    }
}
