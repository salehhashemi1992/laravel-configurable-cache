<?php

namespace Salehhashemi1992\CacheManager;

use Illuminate\Support\ServiceProvider;

class CacheManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'salehhashemi1992');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'salehhashemi1992');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cache-manager.php', 'cache-manager');

        // Register the service the package provides.
        $this->app->singleton('cache-manager', function ($app) {
            return new CacheManager;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cache-manager'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/cache-manager.php' => config_path('cache-manager.php'),
        ], 'cache-manager.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/salehhashemi1992'),
        ], 'cache-manager.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/salehhashemi1992'),
        ], 'cache-manager.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/salehhashemi1992'),
        ], 'cache-manager.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
