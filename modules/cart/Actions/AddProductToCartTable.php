<?php

namespace Modules\cart\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\cart\Http\Requests\AddToCartRequest;
use Modules\cart\Repository\CartRepositoryInterface;
use Modules\core\Utils\PaginationHelper;

class AddProductToCartTable
{
    protected CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AddToCartRequest $request, $user): LengthAwarePaginator|bool
    {
        $carts = $this->repository->addToCart($request->all(), $user->id);
        if ($carts) {
            $page_size = $request->get('page_size', 10);
            return PaginationHelper::paginate($carts, $page_size);
        }
        return false;
    }
}
