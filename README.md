## Laravel Holiday

With this package you can save dates of holidays or shortened days on your Laravel application.

## Install

Run command: `composer require artarts36/laravel-holiday`

Add Provider: `ArtARTs36\LaravelHoliday\Providers\HolidayProvider`

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

var_dump($isDayOff->determineYear(20);
```
