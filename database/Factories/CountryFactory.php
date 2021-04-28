<?php

use ArtARTs36\LaravelHoliday\Models\Country;

$factory->define(Country::class, function (\Faker\Generator $faker) {
    return [
        Country::FIELD_TITLE => $faker->word,
        Country::FIELD_CODE => $faker->countryCode,
    ];
});
