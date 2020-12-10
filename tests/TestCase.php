<?php

namespace ArtARTs36\LaravelHoliday\Tests;

use ArtARTs36\LaravelHoliday\Providers\HolidayProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setup() : void
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'testing']);

        $this->loadMigrationsFrom(__DIR__ . '/../database/Migrations');
        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->withFactories(__DIR__.'/../database/factories');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [HolidayProvider::class];
    }
}
