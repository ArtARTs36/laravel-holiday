<?php

namespace ArtARTs36\LaravelHoliday\Determiners;

use ArtARTs36\LaravelHoliday\Contracts\WorkTypeDeterminer;
use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectStatus;
use ArtARTs36\LaravelHoliday\Exceptions\SelectedCountryNotAllowed;
use ArtARTs36\LaravelHoliday\Models\Country;
use ArtARTs36\LaravelHoliday\Models\WorkType;
use GuzzleHttp\ClientInterface;

class IsDayOff implements WorkTypeDeterminer
{
    protected const DEFAULT_DELIMITER = '|';

    protected $statusMap = [
        0 => WorkType::SLUG_FULL_TIME,
        1 => WorkType::SLUG_WEEKEND,
        2 => WorkType::SLUG_SHORT_DAY,
        4 => WorkType::SLUG_FULL_TIME,
    ];

    protected $countryMap = [
        Country::CODE_RUS => 'ru',
        Country::CODE_KAZ => 'kz',
        Country::CODE_UKR => 'ua',
    ];

    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function determine(\DateTimeInterface $date, string $country = Country::CODE_RUS): Day
    {
        $query = [
            'year'      => $date->format('Y'),
            'month'     => $date->format('m'),
            'day'       => $date->format('d'),
            'pre'       => 1,
            'cc'        => $this->getCountry($country),
        ];

        $value = $this->performRequest($query)[0];

        return new Day($date, $this->getWorkTypeSlug($value), $this->getCountry($country));
    }

    public function determinePeriod(
        \DateTimeInterface $start,
        \DateTimeInterface $end,
        string $country = Country::CODE_RUS
    ): array {
        $query = [
          'date1'     => $this->format($start),
          'date2'     => $this->format($end),
          'pre'       => 1,
          'delimeter' => static::DEFAULT_DELIMITER,
          'cc'        => $this->getCountry($country),
        ];

        $values = $this->performRequest($query);

        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);

        $days = [];

        foreach ($period as $index => $date) {
            $days[] = new Day($date, $this->getWorkTypeSlug($values[$index]), $country);
        }

        return $days;
    }

    public function determineYear(int $year, string $country = Country::CODE_RUS): array
    {
        $query = [
            'year'      => $year,
            'pre'       => 1,
            'delimeter' => static::DEFAULT_DELIMITER,
            'cc'        => $this->getCountry($country),
        ];

        $values = $this->performRequest($query);

        $date = new \DateTime();
        $date->setDate($year, 1, 1);

        $days = [];

        foreach ($values as $value) {
            $days[] = new Day(clone $date, $this->getWorkTypeSlug($value), $country);

            $date->modify('+1 day');
        }

        return $days;
    }

    protected function performRequest(array $query): array
    {
        $url = '/api/getdata?' . http_build_query($query);

        return explode(static::DEFAULT_DELIMITER, $this->send($url));
    }

    protected function format(\DateTimeInterface $date): string
    {
        return $date->format('Ymd');
    }

    protected function send(string $url): string
    {
        return $this->client->request('GET', $url)->getBody()->getContents();
    }

    protected function getWorkTypeSlug(int $status): string
    {
        if (! isset($this->statusMap[$status])) {
            throw new GivenInCorrectStatus();
        }

        return $this->statusMap[$status];
    }

    protected function getCountry(string $code): string
    {
        if (! isset($this->countryMap[$code])) {
            throw new SelectedCountryNotAllowed();
        }

        return $this->countryMap[$code];
    }
}
