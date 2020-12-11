<?php

namespace ArtARTs36\LaravelHoliday\Providers;

use ArtARTs36\LaravelHoliday\Console\FetchHolidays;
use ArtARTs36\LaravelHoliday\Contracts\WorkTypeDeterminer;
use ArtARTs36\LaravelHoliday\Determiners\IsDayOff;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;

class HolidayProvider extends ServiceProvider
{
    protected const CONFIG_PATH = __DIR__ . '/../../config/holiday.php';

    public function boot()
    {
        $this->mergeConfigFrom(static::CONFIG_PATH, 'holiday');

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->loadMigrationsFrom(__DIR__.'/../../database/Migrations');
            $this->app->make(EloquentFactory::class)->load(__DIR__ . '/../../database/Factories');

            $this->commands([
                FetchHolidays::class,
            ]);

            require_once __DIR__ . '/../../database/Seeders/HolidayDatabaseSeeder.php';
        }

        $this->registerDertiminer();
    }

    public function publishConfig(): void
    {
        $this->publishes([
           static::CONFIG_PATH => config_path('holiday.php'),
        ], 'config');
    }

    protected function registerDertiminer(): void
    {
        $this->app->bind(WorkTypeDeterminer::class, function () {
            return new IsDayOff(new \GuzzleHttp\Client([
                'base_uri' => 'https://isdayoff.ru/',
            ]));
        });
    }
}
