<?php

namespace Ingenious\Untappd;

use Ingenious\Untappd\Concerns\MakesRequests;
use Ingenious\Untappd\Contracts\BeerProvider as BeerProviderContract;

class Untappd extends BeerProviderStub implements BeerProviderContract {

    use MakesRequests;

    /**
     * New up a new Untappd class
     */
    public function __construct()
    {
        parent::__construct();

        $this->endpoint = config('untappd.endpoint');

        $this->client_id = config('untappd.client_id');

        $this->secret = config('untappd.secret');

        $this->username = config('untappd.username');

        $this->params = [];
    }

    /**
     * Get the beers
     * @method beers
     * @param  $offset  int
     * @param  $limit  int
     * @param  $sort  string  date|checkin|highest_rated|lowest_rated|highest_rated_you|lowest_rated_you
     *
     * @return   void
     */
    public function beers($offset = 0, $limit = 50, $sort = "date")
    {
        return $this->addParam('offset',$offset)
            ->addParam('limit',$limit)
            ->addParam('sort',$sort)
            ->getJson("user/beers/{$this->username}");
    }
}
