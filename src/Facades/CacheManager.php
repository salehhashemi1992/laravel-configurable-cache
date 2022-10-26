<?php

namespace Salehhashemi1992\CacheManager\Facades;

use Illuminate\Support\Facades\Facade;

class CacheManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cache-manager';
    }
}
