### Laravel Holiday

## Install

Run command: `composer require artarts36/laravel-holiday`

Add Provider: `ArtARTs36\LaravelHoliday\Providers\HolidayProvider`

### Examples

##### Determine work type/status

```php
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://isdayoff.ru/',
]);

$isDayOff = new \ArtARTs36\LaravelHoliday\Determiners\IsDayOff($client);

var_dump($isDayOff->determine(\Carbon\Carbon::parse('2020-11-04'))); // string(8) "not_work"
```

#### Determine work type/status by Period

