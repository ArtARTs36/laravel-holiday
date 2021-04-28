<?php

namespace ArtARTs36\LaravelHoliday\Collections;

use ArtARTs36\LaravelHoliday\Models\Holiday;
use Webmozart\Assert\Assert;

class HolidayCollection implements \IteratorAggregate, \Countable
{
    protected $holidays;

    /**
     * @param array<string, array<Holiday>> $holidays
     */
    protected function __construct(array $holidays)
    {
        $this->holidays = $holidays;
    }

    /**
     * @return array<string>
     */
    public function keys(): array
    {
        return array_keys($this->holidays);
    }

    /**
     * @return array<Holiday>
     */
    public function all(): array
    {
        return $this->holidays;
    }

    public function first(): Holiday
    {
        $first = $this->holidays[array_key_first($this->holidays)];

        return $first[array_key_first($first)];
    }

    public function last(): Holiday
    {
        $last = end($this->holidays);

        return end($last);
    }

    /**
     * @param array<Holiday> $holidays
     */
    public static function make(array $holidays): self
    {
        Assert::notEmpty($holidays);

        $prepared = $holidays;

        usort($prepared, function (Holiday $one, Holiday $two) {
            return $one->date <=> $two->date;
        });

        $grouped = [];

        foreach ($prepared as $holiday) {
            $dateString = $holiday->date_string;

            if (! array_key_exists($dateString, $grouped)) {
                $grouped[$dateString][] = $holiday;
            }
        }

        return new static($grouped);
    }

    public function has(\DateTimeInterface $date): bool
    {
        return array_key_exists($date->format('Y-m-d'), $this->holidays);
    }

    public function get(\DateTimeInterface $date): ?array
    {
        $dateString = $date->format('Y-m-d');

        return array_key_exists($dateString, $this->holidays) ?
            $this->holidays[$dateString] :
            null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->holidays);
    }

    public function count()
    {
        return count($this->holidays);
    }
}
