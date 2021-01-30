<?php

namespace ArtARTs36\LaravelHoliday\Contracts;

use ArtARTs36\LaravelHoliday\Models\Holiday;
use Illuminate\Support\Collection;

interface HolidayRepository
{
    /**
     * @return Collection<Holiday>
     */
    public function getWithTypeByPeriod(\DateTimeInterface $start, \DateTimeInterface $end): Collection;
}
