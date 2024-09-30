<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withRouting(
        using: function () {
            $modules = config('app.modules');
            foreach ($modules as $module) {
                $namespace = 'Modules\\' . $module . '\\Http\\Controllers';

                $apiRoutes = base_path('modules/' . $module . '/routes/api.php');
                $webRoutes = base_path('modules/' . $module . '/routes/web.php');
                $consoleRoutes = base_path('modules/' . $module . '/routes/console.php');
                if (file_exists($apiRoutes)) {
                    Route::middleware('api')
                        ->prefix('api')
                        ->namespace($namespace)
                        ->group($apiRoutes);
                }
                if (file_exists($webRoutes)) {
                    Route::middleware('web')
                        ->namespace($namespace)
                        ->group($webRoutes);
                }
                if (file_exists($consoleRoutes)) {
                    Route::namespace($namespace)
                        ->group($consoleRoutes);
                }
            }
        },
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
