<?php

namespace ArtARTs36\LaravelHoliday\Entities;

class Day
{
    protected $date;

    protected $workTypeSlug;

    public function __construct(\DateTimeInterface $date, string $workTypeSlug)
    {
        $this->date = $date;
        $this->workTypeSlug = $workTypeSlug;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getWorkTypeSlug(): string
    {
        return $this->workTypeSlug;
    }
}
