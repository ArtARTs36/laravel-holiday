<?php

namespace ArtARTs36\LaravelHoliday\Determiners;

use ArtARTs36\LaravelHoliday\Contracts\WorkTypeDeterminer;
use ArtARTs36\LaravelHoliday\Entities\Day;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectStatus;
use ArtARTs36\LaravelHoliday\Models\WorkType;
use GuzzleHttp\ClientInterface;

class IsDayOff implements WorkTypeDeterminer
{
    protected $map = [
        0 => WorkType::SLUG_FULL_TIME,
        1 => WorkType::SLUG_WEEKEND,
        2 => WorkType::SLUG_SHORT_DAY,
        4 => WorkType::SLUG_FULL_TIME,
    ];

    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function determine(\DateTimeInterface $date): string
    {
        return $this->getSlug((int) $this->send($this->genUrlForOneDate($date)));
    }

    public function determinePeriod(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        $query = [
          'date1'     => $this->format($start),
          'date2'     => $this->format($end),
          'pre'       => 1,
          'delimeter' => '|',
        ];

        $url = '/api/getdata?' . http_build_query($query);

        $values = explode('|', $this->send($url));

        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);

        $days = [];

        foreach ($period as $index => $date) {
            $days[] = new Day($date, $this->getSlug($values[$index]));
        }

        return $days;
    }

    protected function genUrlForOneDate(\DateTimeInterface $date): string
    {
        return $this->format($date) . '?pre=1';
    }

    protected function format(\DateTimeInterface $date): string
    {
        return $date->format('Ymd');
    }

    protected function send(string $url): string
    {
        return $this->client->request('GET', $url)->getBody()->getContents();
    }

    protected function getSlug(int $status): string
    {
        if (! isset($this->map[$status])) {
            throw new GivenInCorrectStatus();
        }

        return $this->map[$status];
    }
}
