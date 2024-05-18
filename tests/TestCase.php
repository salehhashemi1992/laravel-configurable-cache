<?php

namespace Salehhashemi\ConfigurableCache\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Salehhashemi\ConfigurableCache\ConfigurableCacheServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [ConfigurableCacheServiceProvider::class];
    }
}
