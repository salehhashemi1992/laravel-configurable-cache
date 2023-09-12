<?php

namespace Salehhashemi1992\ConfigurableCache\Tests;

use Salehhashemi1992\ConfigurableCache\ConfigurableCache;
use Salehhashemi1992\ConfigurableCache\ConfigurableCacheServiceProvider;

class ConfigurableCacheTest extends BaseTest
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [ConfigurableCacheServiceProvider::class];
    }

    /** @test */
    public function test_get_function_retrieves_correct_value_from_cache()
    {
        ConfigurableCache::put('testKey', 'testValue', 'default');

        $value = ConfigurableCache::get('testKey', 'default');

        $this->assertEquals('testValue', $value);
    }
}
