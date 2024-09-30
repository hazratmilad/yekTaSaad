<?php

namespace Modules\cart\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\cart\Http\Requests\AddToCartRequest;
use Modules\cart\Repository\CartRepositoryInterface;
use Modules\core\Utils\PaginationHelper;

class CartListTable
{
    protected CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($user): LengthAwarePaginator|bool
    {
        $carts = $this->repository->getUserCart($user->id);
        return PaginationHelper::paginate($carts, 10);
    }
}
