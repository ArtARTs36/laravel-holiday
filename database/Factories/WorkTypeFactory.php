<?php

use ArtARTs36\LaravelHoliday\Models\WorkType;

$factory->define(WorkType::class, function (\Faker\Generator $faker) {
    return [
        WorkType::FIELD_TITLE => $faker->word,
        WorkType::FIELD_SLUG => $faker->word,
    ];
});
