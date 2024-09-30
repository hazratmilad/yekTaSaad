<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::resource('products', 'ProductController')
        ->except(['edit', 'create', 'show']);
});
