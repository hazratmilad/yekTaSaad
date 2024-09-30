<?php

namespace Modules\cart\Repository;

interface CartRepositoryInterface
{
    public function addToCart(array $request, $userId);

    public function removeProductFromCart(array $request, $userId);

    public function findProductInCart($productId, $userId);
    public function getUserCart($userId);
}
