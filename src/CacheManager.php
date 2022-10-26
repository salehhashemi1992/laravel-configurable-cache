<?php

namespace Salehhashemi1992\CacheManager;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CacheManager
{
    /**
     * > Get a value from the cache
     *
     * @param string $key The key to store the value under.
     * @param string $config The name of the configuration to use.
     * @return mixed The value of the key in the cache.
     */
    public static function get(string $key, string $config = 'default'): mixed
    {
        /* It's getting the prefix of the cache. */
        $key = config('cache-manager.configs.' . $config . '.prefix') . $key;

        return Cache::get($key);
    }

    /**
     * It stores a value in the cache for a given key.
     *
     * @param string $key The key to store the value under.
     * @param mixed $value The value to store.
     * @param string $config The name of the configuration to use.
     * @return bool A boolean value.
     */
    public static function put(string $key, mixed $value, string $config = 'default'): bool
    {
        /* It's getting the duration of the cache. */
        $ttl = Carbon::parse(
            config('cache-manager.configs.' . $config . '.duration')
        );

        /* It's getting the prefix of the cache. */
        $key = config('cache-manager.configs.' . $config . '.prefix') . $key;

        return Cache::put($key, $value, $ttl);
    }

    /**
     * It deletes a cache
     *
     * @param string $key The key of the cache.
     * @param string $config The name of the configuration to use.
     * @return bool A boolean value.
     */
    public static function delete(string $key, string $config = 'default'): bool
    {
        /* It's getting the prefix of the cache. */
        $key = config('cache-manager.configs.' . $config . '.prefix') . $key;

        return Cache::forget($key);
    }
}
