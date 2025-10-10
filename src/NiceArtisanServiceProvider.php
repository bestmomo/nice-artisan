<?php

namespace Bestmomo\NiceArtisan;

use Illuminate\Support\ServiceProvider;
use Bestmomo\NiceArtisan\Http\Middleware\EnsureAjax;

class NiceArtisanServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Views
        $this->loadViewsFrom(__DIR__.'/../views', 'NiceArtisan');

        // Config
        $this->publishes([
            __DIR__ . '/../config/niceartisan.php' => config_path('niceartisan.php'),
        ], 'niceartisan:config');

        // Middleware
        $this->app['router']->aliasMiddleware('niceartisan.ajax', EnsureAjax::class);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(){}

}
