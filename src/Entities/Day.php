<?php

namespace ArtARTs36\LaravelHoliday\Entities;

class Day
{
    protected $date;

    protected $workTypeSlug;

    protected $countryCode;

    public function __construct(\DateTimeInterface $date, string $workTypeSlug, string $countryCode)
    {
        $this->date = $date;
        $this->workTypeSlug = $workTypeSlug;
        $this->countryCode = $countryCode;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getWorkTypeSlug(): string
    {
        return $this->workTypeSlug;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
