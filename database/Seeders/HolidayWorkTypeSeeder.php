<?php

use ArtARTs36\LaravelHoliday\Models\WorkType;
use Illuminate\Database\Seeder;

class HolidayWorkTypeSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            WorkType::SLUG_FULL_TIME => 'Рабочий день',
            WorkType::SLUG_SHORT_DAY => 'Сокращенный день',
            WorkType::SLUG_WEEKEND => 'Выходной день',
        ];

        foreach ($map as $slug => $title) {
            WorkType::query()->create([
                WorkType::FIELD_SLUG => $slug,
                WorkType::FIELD_TITLE => $title,
            ]);
        }
    }
}
