<?php

namespace Modules\users\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\users\Models\User;
use Modules\users\Repository\EloquentUserRepository;
use Modules\users\Repository\UserRepositoryInterface;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(base_path('modules/users/database/migrations'));
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    public function boot(): void
    {
        \Illuminate\Database\Eloquent\Builder::macro('user', function () {
            return $this->getModel()->belongsTo(User::class, 'user_id', 'id');
        });
    }
}
