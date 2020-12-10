<?php

namespace ArtARTs36\LaravelHoliday\Console;

use ArtARTs36\LaravelHoliday\Contracts\WorkTypeDeterminer;
use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Models\Holiday;
use ArtARTs36\LaravelHoliday\Models\WorkType;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class FetchHolidays extends Command
{
    protected $signature = 'holiday:fetch {type}';

    public function handle(WorkTypeDeterminer $determiner)
    {
        $type = $this->argument('type');

        if ($type === 'month') {
            $days = $determiner->determinePeriod(Carbon::parse('1 month ago'), Carbon::now());
        } else if ($type === '2months') {
            $days = $determiner->determinePeriod(Carbon::parse('2 month ago'), Carbon::now());
        } elseif ($type === 'year') {
            $days = $determiner->determineYear(Carbon::now()->year);
        } else {
            $this->comment('Given incorrect type!');

            return;
        }

        $this->saveDays($days);
    }

    /**
     * @param array<Day> $days
     */
    protected function saveDays(array $days): void
    {
        $workTypes = WorkType::all()->pluck(null, WorkType::FIELD_SLUG);

        foreach ($days as $day) {
            if (! WorkType::isHoliday($day->getWorkTypeSlug())) {
                continue;
            }

            Holiday::query()->create([
                Holiday::FIELD_WORK_TYPE_ID => $workTypes[$day->getWorkTypeSlug()]->id,
                Holiday::FIELD_DATE => $day->getDate(),
            ]);
        }
    }
}
