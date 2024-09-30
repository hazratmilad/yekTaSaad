<?php

namespace Modules\core\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once base_path('modules/core/helpers.php');
        $this->loadMigrationsFrom(base_path('modules/core/database/migrations'));
        addModuleProviders();
    }

    public function boot()
    {

    }
}
