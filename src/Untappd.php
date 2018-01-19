<?php

namespace Ingenious\Untappd;

use stdClass;
use Illuminate\Support\Facades\Cache;
use Ingenious\Untappd\Concerns\MakesRequests;

class Untappd extends BeerProviderStub {

    use MakesRequests;

    private $params;

    /**
     * New up a new Untappd class
     */
    public function __construct()
    {
        parent::__construct();

        $this->endpoint = config('untappd.endpoint');

        $this->client_id = config('untappd.client_id');

        $this->secret = config('untappd.secret');

        $this->brewery_id = config('untappd.brewery_id');

        $this->params = [];
    }


    /**
     * Get all the beers
     * @method beers
     *
     * @return StdClass
     */
    public function beers() : StdClass
    {
        $return = $this->getBeers($offset = 0, $limit = 50, "date")->response;

        while( $return->beers->count < $return->total_count )
        {
            $temp = $this->getBeers($offset += 50, $limit, "date")->response;

            $return->beers->count += $temp->beers->count;
            $return->beers->items = $return->beers->items->merge( $temp->beers->items );
        }

        return $return;
    }

    /**
     * Get the beers from the api
     * @method getBeers
     * @param  $offset  int
     * @param  $limit  int
     * @param  $sort  string  date|checkin|highest_rated|lowest_rated|highest_rated_you|lowest_rated_you
     *
     * @return   StdClass
     */
    public function getBeers($offset = 0, $limit = 50, $sort = "date") : StdClass
    {
        $cacheKey = "untappd.beers.{$offset}.{$limit}.{$sort}";

        return Cache::remember( $cacheKey, 60 * 24, function() use ($offset,$limit,$sort) {

            $json = $this->addParam('offset',$offset)
                ->addParam('limit',$limit)
                ->addParam('sort',$sort)
                ->getJson("brewery/beer_list/{$this->brewery_id}");

            $json->response = (object) $json->response;
            $json->response->beers = (object) $json->response->beers;
            $json->response->beers->items = collect($json->response->beers->items);

            return $json;
        });

    }
}
