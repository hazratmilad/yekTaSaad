<?php

namespace Modules\products\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\products\Events\CheckProductInventory;
use Modules\products\Events\FindOrFailProduct;
use Modules\products\Events\ProductCreationEmailNotification;
use Modules\products\Events\UpdateProductInventory;
use Modules\products\Models\Product;
use Modules\products\Repository\EloquentProductRepository;
use Modules\products\Repository\ProductRepositoryInterface;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        addEvent('product.created', ProductCreationEmailNotification::class);
        addEvent('product.findOrFail', FindOrFailProduct::class);
        addEvent('product.update.inventory', UpdateProductInventory::class);
        addEvent('product.check.has.inventory', CheckProductInventory::class);

        $this->loadViewsFrom(base_path('modules/products/resources/views'), 'products');
        $this->loadMigrationsFrom(base_path('modules/products/database/migrations'));
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
    }

    public function boot(): void
    {
        \Illuminate\Database\Eloquent\Builder::macro('product', function () {
            return $this->getModel()->belongsTo(Product::class, 'product_id', 'id');
        });
    }
}
