<?php

use ArtARTs36\LaravelHoliday\Models\Country;
use Illuminate\Database\Seeder;

class HolidayCountrySeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            Country::CODE_UKR => 'Украина',
            Country::CODE_RUS => 'Россия',
            Country::CODE_KAZ => 'Казахстан',
        ];

        foreach ($map as $code => $title) {
            Country::query()->create([
                Country::FIELD_CODE => $code,
                Country::FIELD_TITLE => $title,
            ]);
        }
    }
}
