<?php

namespace Ingenious\Untappd\Contracts;

use \StdClass;

interface BeerProvider {

    public function beers($offset, $limit, $sort) : StdClass;

}
