<?php

declare(strict_types=1);

namespace Salehhashemi1992\ConfigurableCache;

use Carbon\CarbonInterface;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ConfigurableCache
{
    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     *
     * @template TCacheValue
     *
     * @param string $key The cache key to retrieve or store the item.
     * @param string $config The cache configuration to use (e.g., 'default').
     * @param \Closure(): TCacheValue $callback The Closure to execute if the item is not found in the cache.
     * @return TCacheValue The cached item or the result of the Closure execution.
     */
    public static function remember(string $key, string $config, Closure $callback): mixed
    {
        $cacheKey = static::cacheKey($key, $config);
        $ttl = static::ttl($config);

        return Cache::remember($cacheKey, $ttl, $callback);
    }

    /**
     * Get a value from the cache
     *
     * @param  string  $key The key to store the value under.
     * @param  string  $config The name of the configuration to use.
     */
    public static function get(string $key, string $config = 'default'): mixed
    {
        $cacheKey = static::cacheKey($key, $config);

        return Cache::get($cacheKey);
    }

    /**
     * It stores a value in the cache for a given key.
     *
     * @param  string  $key The key to store the value under.
     * @param  mixed  $value The value to store.
     * @param  string  $config The name of the configuration to use.
     *
     * @throws \RuntimeException
     */
    public static function put(string $key, mixed $value, string $config = 'default'): void
    {
        $cacheKey = static::cacheKey($key, $config);
        $ttl = static::ttl($config);

        $result = Cache::put($cacheKey, $value, $ttl);

        if (! $result) {
            throw new \RuntimeException('Failed to store data in the cache.');
        }
    }

    /**
     * @param  string  $key The name of the configuration to use.
     * @param  string  $config The name of the configuration to use.
     */
    public static function increment(string $key, string $config = 'default'): void
    {
        $cacheKey = static::cacheKey($key, $config);
        Cache::increment($cacheKey);
    }

    /**
     * It deletes a cache
     *
     * @param  string  $key The key of the cache.
     * @param  string  $config The name of the configuration to use.
     */
    public static function delete(string $key, string $config = 'default'): bool
    {
        $cacheKey = static::cacheKey($key, $config);

        return Cache::forget($cacheKey);
    }

    /**
     * Generate a cache key for the given key and configuration.
     *
     * @param string $key The key to be included in the cache key.
     * @param string $config The cache configuration name (e.g., 'default').
     * @return string The generated cache key.
     */
    protected static function cacheKey(string $key, string $config): string
    {
        return config('configurable-cache.configs.'.$config.'.prefix').$key;
    }

    /**
     * Get the Time To Live (TTL) duration for cache items based on the specified configuration.
     *
     * @param string $config The cache configuration name (e.g., 'default').
     * @return CarbonInterface A Carbon instance representing the TTL duration.
     */
    protected static function ttl(string $config): CarbonInterface
    {
        return Carbon::parse(
            config('configurable-cache.configs.'.$config.'.duration')
        );
    }
}
