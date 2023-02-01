<?php

namespace Alijumaan\LaravelPermissionEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Alijumaan\LaravelPermissionEditor\Http\Middleware\SpatiePermissionMiddleware;
use Illuminate\Support\Facades\Route;

class PermissionEditorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(): void
    {
        Route::prefix('permission-editor')
            ->as('permission-editor.')
            ->middleware(config('permission-editor.middleware', ['web', 'spatie-permission']))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('spatie-permission', SpatiePermissionMiddleware::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'permission-editor');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('permission-editor'),
            ], 'assets');

            $this->publishes([
                __DIR__.'/../config/permission-editor.php' => config_path('permission-editor.php'),
            ], 'permission-editor-config');

            /*
             * // This way to use migration if we need inside our package
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            */


           /*
            * // This way to publish migration files
                $this->publishes([
                    __DIR__ . '/../database/migrations/2023_01_01_100000_create_tasks_table.php' =>
                        database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tasks_table.php'),

                    // More migration files here
                ], 'migrations');
           */

            /*
             * //  This way to use our Artisan Command if we need inside our package
             *  $this->commands([
                    MakeTaskCommand::class,
                ]);
            */
        }
    }
}
