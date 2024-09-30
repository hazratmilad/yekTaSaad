<?php

use Illuminate\Support\Facades\Route;

Route::prefix('cart')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', 'CartListController');
    Route::post('add-product', 'AddProductToCartController');
    Route::post('remove-product', 'RemoveProductFromCartController');
});
