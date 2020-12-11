<?php

use Illuminate\Database\Seeder;

require_once 'HolidayWorkTypeSeeder.php';
require_once 'HolidayCountrySeeder.php';

class HolidayDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(\HolidayWorkTypeSeeder::class);
        $this->call(\HolidayCountrySeeder::class);
    }
}
