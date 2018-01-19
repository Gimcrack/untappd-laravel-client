<?php

namespace Ingenious\Untappd;

use Ingenious\Untappd\Contracts\BeerProvider;
use Ingenious\Untappd\Concerns\BeerProviderCanBeFaked;

abstract class BeerProviderStub implements BeerProvider{

    use BeerProviderCanBeFaked;

    protected $faker;

    protected $endpoint;

    protected $client_id;

    protected $secret;

    protected $brewery_id;

    protected $force_flag;

    public function __construct()
    {
        $this->force_flag = false;
    }

    /**
     * Force a refresh
     * @method force
     * @return BeerProvider
     */
    public function force() : BeerProvider
    {
        $this->force_flag = true;

        return $this;
    }
}
