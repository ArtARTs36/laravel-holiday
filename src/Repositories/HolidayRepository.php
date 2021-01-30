<?php

namespace ArtARTs36\LaravelHoliday\Repositories;

use ArtARTs36\LaravelHoliday\Models\Holiday;
use Illuminate\Support\Collection;

class HolidayRepository
{
    /**
     * @return Collection<Holiday>
     */
    public function getWithTypeByPeriod(\DateTimeInterface $start, \DateTimeInterface $end): Collection
    {
        return Holiday::query()
            ->with(Holiday::RELATION_WORK_TYPE)
            ->whereDate(Holiday::FIELD_DATE, '>=', $start)
            ->whereDate(Holiday::FIELD_DATE, '<=', $end)
            ->get();
    }
}
