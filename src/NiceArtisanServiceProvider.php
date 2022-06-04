<?php

namespace Bestmomo\NiceArtisan;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;

class NiceArtisanServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Get namespace
        $nameSpace = $this->app->getNamespace();

        // Set namespace alias for NiceArtisanController
        AliasLoader::getInstance()->alias('AppController', $nameSpace . 'Http\Controllers\Controller');

        // Set namespace alias for Kernel
        AliasLoader::getInstance()->alias('AppKernel', $nameSpace . 'Http\Kernel');

        // Routes
        Route::middleware(config('commands.settings.middlewares'))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
            });

        // Views
        $this->loadViewsFrom(__DIR__.'/../views', 'NiceArtisan');

        // Config
        $this->publishes([
            __DIR__ . '/../config/commands.php' => config_path('commands.php'),
        ], 'niceartisan:config');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(){}

}