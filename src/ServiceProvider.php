<?php

namespace AndreaMarelli\ImetCore;

use AndreaMarelli\ImetCore\Console\Commands\ApplySQL;
use AndreaMarelli\ImetCore\Console\Commands\Export;
use AndreaMarelli\ImetCore\Console\Commands\GetSerialNumber;
use AndreaMarelli\ImetCore\Console\Commands\Import;
use AndreaMarelli\ImetCore\Console\Commands\InitDB;
use AndreaMarelli\ImetCore\Console\Commands\PopulateMetadata;
use AndreaMarelli\ImetCore\Console\Commands\PopulateSpecies;
use AndreaMarelli\ImetCore\Console\Commands\SetSerialNumber;
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
        $this->loadRoutesFrom(__DIR__.'/../src/Routes/api.php');

        // Config
        $this->publishes([__DIR__.'/../config/config.php' => config_path('imet-core.php')], 'config');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                ApplySQL::class,
                Export::class,
                GetSerialNumber::class,
                Import::class,
                InitDB::class,
                PopulateMetadata::class,
                PopulateSpecies::class,
                SetSerialNumber::class
            ]);
        }
    }

}
