<?php

namespace Ingenious\Untappd\Concerns;

use Ingenious\Untappd\Untappd as UntappdProvider;
use Ingenious\Untappd\UntappdFake;
use Ingenious\Untappd\Facades\Untappd;

trait BeerProviderCanBeFaked
{
    /**
     * Swap out the ticket provider
     * @method fake
     *
     * @return   this
     */
    public function fake()
    {
        Untappd::swap( new UntappdFake );

        return app('Untappd');
    }

    /**
     * Swap out the fake provider for a real one
     * @method dontFake
     *
     * @return   this
     */
    public function dontFake()
    {
        Untappd::swap( new UntappdProvider );

        return app('Untappd');
    }
}
