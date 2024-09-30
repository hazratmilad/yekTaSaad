<?php

namespace Modules\products\Http\Controllers;

use Illuminate\Http\Request;
use Modules\core\Http\Controllers\CrudController;
use Modules\core\Repositories\BaseRepositoryInterface;
use Modules\products\Actions\CreateProduct;
use Modules\products\Actions\ProductList;
use Modules\products\Actions\UpdateProduct;
use Modules\products\Http\Requests\ProductRequest;
use Modules\products\Http\Resources\ProductResource;
use Modules\products\Repository\ProductRepositoryInterface;

class ProductController extends CrudController
{
    protected BaseRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, ProductList $productList)
    {
        $products = $productList($request);
        return $this->success(ProductResource::collection($products));
    }

    public function store(ProductRequest $request,
                          CreateProduct  $createProduct)
    {
        $product = $createProduct($request);
        return $this->success(new ProductResource($product));
    }

    public function update(ProductRequest $request, $id, UpdateProduct $updateProduct)
    {
        $product = $updateProduct($request, $id);
        return $this->success(new ProductResource($product));
    }
}
