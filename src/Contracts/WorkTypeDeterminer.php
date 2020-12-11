<?php

namespace ArtARTs36\LaravelHoliday\Contracts;

use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectStatus;
use ArtARTs36\LaravelHoliday\Models\Country;

interface WorkTypeDeterminer
{
    /**
     * @return string - slug
     * @throws GivenInCorrectStatus
     */
    public function determine(\DateTimeInterface $date, string $country = Country::CODE_RUS): Day;

    /**
     * @return array<Day>
     */
    public function determinePeriod(
        \DateTimeInterface $start,
        \DateTimeInterface $end,
        string $country = Country::CODE_RUS
    ): array;

    /**
     * @return array<Day>
     */
    public function determineYear(int $year, string $country = Country::CODE_RUS): array;
}
