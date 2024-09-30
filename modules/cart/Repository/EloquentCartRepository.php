<?php

namespace Modules\cart\Repository;

use Modules\cart\Models\Cart;

class EloquentCartRepository implements CartRepositoryInterface
{
    public function addToCart(array $request, $userId)
    {
        $product = runEvent('product.findOrFail', $request['product_id'], true);
        $productCount = $request['product_count'];

        if (!runEvent('product.check.has.inventory', ['productId' => $product->id, 'productCount' => $productCount], true)) {
            return false;
        }

        \DB::transaction(function () use ($product, $userId, $productCount) {
            if ($cart = $this->findProductInCart($product->id, $userId)) {

                $cart->lockForUpdate()->update([
                    'count' => bcadd($cart->count, $productCount),
                    'price' => bcadd($cart->price, bcmul($product->price, $productCount))
                ]);

            } else {
                $cart = Cart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'count' => $productCount,
                    'price' => bcmul($product->price, $productCount)
                ]);
            }

            runEvent('product.update.inventory', ['productId' => $cart->product_id, 'kind' => 'decrease', 'count' => $cart->count]);
        });

        return $this->getUserCart($userId);
    }

    public function removeProductFromCart(array $request, $userId)
    {
        $product = runEvent('product.findOrFail', $request['product_id'], true);

        if ($cart = $this->findProductInCart($product->id, $userId)) {
            \DB::transaction(function () use ($cart) {
                runEvent('product.update.inventory', ['productId' => $cart->product_id, 'kind' => 'increase', 'count' => $cart->count]);
                $cart->delete();
            });
        }
        return $this->getUserCart($userId);
    }

    public function findProductInCart($productId, $userId)
    {
        return Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    }

    public function getUserCart($userId)
    {
        return Cart::with('product', 'user')->where('user_id', $userId)->get();
    }
}
