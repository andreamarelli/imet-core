<?php

namespace AndreaMarelli\ImetCore;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'imet-core');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/../src/Views', 'imet-core');
        $this->publishes([__DIR__.'/../src/Views' => resource_path('views/vendor/imet-core')], 'views');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../src/Routes/web.php');

        // Config
        $this->publishes([__DIR__.'/../config/config.php' => config_path('imet-core.php')], 'config');
    }

}
