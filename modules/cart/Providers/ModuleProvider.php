<?php

namespace Modules\cart\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\cart\Repository\CartRepositoryInterface;
use Modules\cart\Repository\EloquentCartRepository;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(base_path('modules/cart/database/migrations'));
        $this->app->bind(CartRepositoryInterface::class, EloquentCartRepository::class);
    }

    public function boot(): void
    {

    }
}
