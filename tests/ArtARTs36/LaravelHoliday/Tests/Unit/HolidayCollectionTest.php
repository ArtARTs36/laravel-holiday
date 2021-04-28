<?php

namespace ArtARTs36\LaravelHoliday\Tests\Unit;

use ArtARTs36\LaravelHoliday\Collections\HolidayCollection;
use ArtARTs36\LaravelHoliday\Models\Holiday;
use ArtARTs36\LaravelHoliday\Tests\TestCase;
use Carbon\Carbon;

class HolidayCollectionTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelHoliday\Collections\HolidayCollection::make
     */
    public function testMakeBadNotEmpty(): void
    {
        self::expectException(\InvalidArgumentException::class);

        HolidayCollection::make([]);
    }

    /**
     * @covers \ArtARTs36\LaravelHoliday\Collections\HolidayCollection::make
     */
    public function testMake(): void
    {
        $one = factory(Holiday::class)->create([Holiday::FIELD_DATE => Carbon::parse('3 month ago')]);
        $two = factory(Holiday::class)->create([Holiday::FIELD_DATE => Carbon::parse('2 month ago')]);
        $three = factory(Holiday::class)->create([Holiday::FIELD_DATE => Carbon::parse('1 month ago')]);

        $expected = [[$one], [$two], [$three]];
        $holidays = [$one, $two, $three];
        shuffle($holidays);

        $collection = HolidayCollection::make($holidays);

        self::assertEquals($expected, array_values($collection->all()));
    }

    /**
     * @covers \ArtARTs36\LaravelHoliday\Collections\HolidayCollection::has
     */
    public function testHas(): void
    {
        /** @var Holiday $holiday */
        $holiday = factory(Holiday::class)->create();

        $collection = HolidayCollection::make([$holiday]);

        self::assertTrue($collection->has($holiday->date));
    }
}
