## Laravel Holiday

With this package you can save dates of holidays or shortened days on your Laravel application.

![Testing](https://github.com/ArtARTs36/laravel-holiday/workflows/Testing/badge.svg?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
<a href="https://poser.pugx.org/artarts36/laravel-holiday/d/total.svg">
    <img src="https://poser.pugx.org/artarts36/laravel-holiday/d/total.svg" alt="Total Downloads">
</a>

## Install

Run command: `composer require artarts36/laravel-holiday`

Add Provider: `ArtARTs36\LaravelHoliday\Providers\HolidayProvider`

Run command: `php artisan migrate`

Run command: `php artisan db:seed --class=HolidayDatabaseSeeder`

## Commands

| Command                     | Description                              |
| ------------                | ------------                             |
| holiday:fetch current-year  | Holidays for the current year are saved  |
| holiday:fetch current-month | Holidays for the current month are saved |

## Examples

##### Determine work type by Day

```php
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://isdayoff.ru/',
]);

$isDayOff = new \ArtARTs36\LaravelHoliday\Determiners\IsDayOff($client);

var_dump($isDayOff->determine(\Carbon\Carbon::parse('2020-11-04'))); // string(7) "weekend"
```

##### Determine work type by Period

```php
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://isdayoff.ru/',
]);

$isDayOff = new \ArtARTs36\LaravelHoliday\Determiners\IsDayOff($client);

var_dump($isDayOff->determinePeriod(\Carbon\Carbon::parse('2020-11-04'), \Carbon\Carbon::parse('2020-12-15')));
```

##### Determine work type by Year

```php
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://isdayoff.ru/',
]);

$isDayOff = new \ArtARTs36\LaravelHoliday\Determiners\IsDayOff($client);

var_dump($isDayOff->determineYear(20));
```

##### Save Holidays for a concrete year

```php
$fetch = app(\ArtARTs36\LaravelHoliday\Services\Fetch::class);

$fetch->fetch('2019');
```

##### Save Holidays for a current year

```php
$fetch = app(\ArtARTs36\LaravelHoliday\Services\Fetch::class);

$fetch->fetch(\ArtARTs36\LaravelHoliday\Services\Fetch::TYPE_CURRENT_YEAR);
```

##### Save Holidays for a current month

```php
$fetch = app(\ArtARTs36\LaravelHoliday\Services\Fetch::class);

$fetch->fetch(\ArtARTs36\LaravelHoliday\Services\Fetch::TYPE_CURRENT_MONTH);
```

##### Save Holidays for a next week

```php
$fetch = app(\ArtARTs36\LaravelHoliday\Services\Fetch::class);

$fetch->fetch(\ArtARTs36\LaravelHoliday\Services\Fetch::TYPE_NEXT_WEEK);
```
