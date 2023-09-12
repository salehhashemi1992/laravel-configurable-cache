<?php

namespace Salehhashemi1992\ConfigurableCache;

use Illuminate\Support\ServiceProvider;

class ConfigurableCacheServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/configurable-cache.php', 'configurable-cache');
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/configurable-cache.php' => config_path('configurable-cache.php'),
        ], 'configurable-cache.config');
    }
}
