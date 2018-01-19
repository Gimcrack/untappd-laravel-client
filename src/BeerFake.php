<?php

namespace Ingenious\Untappd;

use Faker\Generator;

class BeerFake {

    public $bid;

    public $beer_name;

    public $beer_label;

    public $beer_abv;

    public $beer_ibu;

    public $beer_slug;

    public $beer_style;

    public $beer_description;

    public $created_at;

    public $auth_rating;

    public $wish_list;

    public $rating_score;


    /**
     * Make a new fake beer
     * @method __construct
     *
     * @param Generator $faker
     */
    public function __construct( Generator $faker)
    {
        $this->bid = $faker->randomDigit;

        $this->beer_name = $faker->word;

        $this->beer_label = $faker->imageUrl();

        $this->beer_abv = $faker->word;

        $this->beer_ibu = $faker->word;

        $this->beer_slug = $faker->word;

        $this->beer_style = $faker->word;

        $this->beer_description = $faker->sentence;

        $this->created_at = $faker->date();

        $this->auth_rating = $faker->word;

        $this->rating_score = $faker->word;
    }

}
