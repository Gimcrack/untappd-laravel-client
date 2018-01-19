<?php

namespace Ingenious\Untappd\Contracts;

use StdClass;

interface BeerProvider {

    public function beers() : StdClass;
}
