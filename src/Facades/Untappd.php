<?php

namespace Ingenious\Untappd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ingenious\Untappd\Untappd
 */
class Untappd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Untappd';
    }
}
