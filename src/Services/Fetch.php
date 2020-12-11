<?php

namespace ArtARTs36\LaravelHoliday\Services;

use ArtARTs36\LaravelHoliday\Contracts\WorkTypeDeterminer;
use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectFetchType;
use ArtARTs36\LaravelHoliday\Models\Holiday;
use ArtARTs36\LaravelHoliday\Models\WorkType;
use Illuminate\Support\Carbon;

class Fetch
{
    public const TYPE_CURRENT_YEAR = 'current-year';
    public const TYPE_CURRENT_MONTH = 'current-month';

    protected $determiner;

    public function __construct(WorkTypeDeterminer $determiner)
    {
        $this->determiner = $determiner;
    }

    /**
     * @return array<Holiday>
     * @throws GivenInCorrectFetchType
     */
    public function fetch(string $type): array
    {
        switch ($type) {
            case static::TYPE_CURRENT_MONTH:
                $days = $this->determiner->determinePeriod(Carbon::parse('1 month ago'), Carbon::now());

                break;
            case static::TYPE_CURRENT_YEAR:
                $days = $this->determiner->determineYear(Carbon::now()->year);

                break;
            default:
                throw new GivenInCorrectFetchType();
        }

        return $this->saveDays($days);
    }

    /**
     * @param array<Day> $days
     * @return array<Holiday>
     */
    protected function saveDays(array $days): array
    {
        $workTypes = WorkType::all()->pluck(null, WorkType::FIELD_SLUG);

        $holidays = [];

        foreach ($days as $day) {
            if (! WorkType::isHoliday($day->getWorkTypeSlug())) {
                continue;
            }

            $holidays[] = Holiday::query()->create([
                Holiday::FIELD_WORK_TYPE_ID => $workTypes[$day->getWorkTypeSlug()]->id,
                Holiday::FIELD_DATE => $day->getDate(),
            ]);
        }

        return $holidays;
    }
}
