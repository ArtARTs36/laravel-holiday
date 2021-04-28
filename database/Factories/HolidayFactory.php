<?php

use ArtARTs36\LaravelHoliday\Models\Country;
use ArtARTs36\LaravelHoliday\Models\Holiday;
use ArtARTs36\LaravelHoliday\Models\WorkType;

$factory->define(Holiday::class, function (\Faker\Generator $faker) {
    return [
        Holiday::FIELD_DATE => $faker->date(),
        Holiday::FIELD_TITLE => $faker->word,
        Holiday::FIELD_WORK_TYPE_ID => factory(WorkType::class)->create()->id,
        Holiday::FIELD_COUNTRY_ID => factory(Country::class)->create()->id,
    ];
});
