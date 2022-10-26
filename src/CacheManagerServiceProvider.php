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
    public function provides(): array
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
    }
}
