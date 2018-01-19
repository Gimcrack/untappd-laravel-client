<?php

namespace Ingenious\Untappd;

use StdClass;
use Faker\Generator;
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
     * @return StdClass
     */
    public function beers() : StdClass
    {
        return $this->fakeBeers();
    }

    /**
     * Get some fake beers
     * @method fakeBeers
     *
     * @param int $offset
     * @param int $limit
     * @param string $sort
     * @return object
     */
    private function fakeBeers($offset = 0, $limit = 50, $sort = "date")
    {
        $beers = collect( range(1,$limit) )
            ->transform( function() {
                return new BeerFake( $this->faker );
            });

        return (object) [
            'beers' => (object) [
                'sort' => $sort,
                'offset' => $offset,
                'limit' => $limit,
                'sort_english' => 'Date (Descending)',
                'count' => $beers->count(),
                'items' => $beers
            ]
        ];
    }
}
