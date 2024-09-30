<?php

namespace Modules\cart\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\cart\Http\Requests\RemoveProductFromCartRequest;
use Modules\cart\Repository\CartRepositoryInterface;
use Modules\core\Utils\PaginationHelper;

class RemoveProductFromCartTable
{
    protected CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RemoveProductFromCartRequest $request, $user): LengthAwarePaginator
    {
        $carts = $this->repository->removeProductFromCart($request->all(), $user->id);
        $page_size = $request->get('page_size', 10);
        return PaginationHelper::paginate($carts, $page_size);
    }
}
