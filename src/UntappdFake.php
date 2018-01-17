<?php

namespace Ingenious\Untappd;

use Cache;
use StdClass;
use Zttp\Zttp;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Support\Collection;
use Ingenious\Untappd\Contracts\BeerProvider as BeerProviderContract;

class UntappdFake extends BeerProviderStub implements BeerProviderContract  {

    /**
     * New up a new UntappdFake class
     */
    public function __construct()
    {
        parent::__construct();

        $this->faker = app(Generator::class);
    }

    /**
     * Get the beers
     * @method beers
     *
     * @return   StdClass
     */
    public function beers($offset = 0, $limit = 50, $sort = "date")
    {
        return $this->fakeBeers($offset, $limit, $sort);
    }

    /**
     * Get some fake beers
     * @method fakeBeers
     *
     * @return   object
     */
    private function fakeBeers($offset = 0, $limit = 50, $sort = "date")
    {
        $beers = collect( range(1,$limit) )
            ->transform( function($num) {
                return new BeerFake( $this->faker );
            });

        return (object) [
            'beers' => [
                'sort' => $sort,
                'offset' => $offset,
                'limit' => $limit,
                'sort_english' => 'Date (Descending)',
                'count' => $beers->count(),
                'items' => $beers->all()
            ]
        ];
    }
}
