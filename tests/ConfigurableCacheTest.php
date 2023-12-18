<?php

namespace Salehhashemi\ConfigurableCache\Tests;

use Salehhashemi\ConfigurableCache\ConfigurableCache;
use Salehhashemi\ConfigurableCache\ConfigurableCacheServiceProvider;

class ConfigurableCacheTest extends BaseTest
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [ConfigurableCacheServiceProvider::class];
    }

    public function test_get_function_retrieves_correct_value_from_cache()
    {
        ConfigurableCache::put('testKey', 'testValue', 'default');

        $value = ConfigurableCache::get('testKey', 'default');

        $this->assertEquals('testValue', $value);
    }

    public function test_delete_function_removes_value_from_cache()
    {
        ConfigurableCache::put('testKey', 'testValue', 'tiny');

        ConfigurableCache::delete('testKey', 'tiny');

        $value = ConfigurableCache::get('testKey', 'tiny');

        $this->assertNull($value);
    }

    public function test_increment_function_increments_cache_value()
    {
        ConfigurableCache::put('testKey', 1);

        ConfigurableCache::increment('testKey');

        $cacheValue = ConfigurableCache::get('testKey');

        $this->assertEquals(2, $cacheValue);
    }

    public function test_remember_function_stores_closure_result_in_cache()
    {
        ConfigurableCache::remember('testKey', function () {
            return 'testValue';
        });

        $value = ConfigurableCache::get('testKey');

        $this->assertEquals('testValue', $value);
    }
}
