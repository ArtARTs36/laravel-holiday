<?php

namespace ArtARTs36\LaravelHoliday\Contracts;

use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectStatus;

interface WorkTypeDeterminer
{
    /**
     * @return string - slug
     * @throws GivenInCorrectStatus
     */
    public function determine(\DateTimeInterface $date): string;

    /**
     * @return array<Day>
     */
    public function determinePeriod(\DateTimeInterface $start, \DateTimeInterface $end): array;

    /**
     * @return array<Day>
     */
    public function determineYear(int $year): array;
}
