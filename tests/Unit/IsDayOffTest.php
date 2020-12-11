<?php

namespace ArtARTs36\LaravelHoliday\Tests\Unit;

use ArtARTs36\LaravelHoliday\Determiners\IsDayOff;
use ArtARTs36\LaravelHoliday\Exceptions\GivenInCorrectStatus;
use ArtARTs36\LaravelHoliday\Models\Name;
use ArtARTs36\LaravelHoliday\Models\WorkType;
use ArtARTs36\LaravelHoliday\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

final class IsDayOffTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelHoliday\Determiners\IsDayOff::determine
     */
    public function testDetermine(): void
    {
        $client = new class extends Client {
            protected $responseData;

            public function request(string $method, $uri = '', array $options = []): ResponseInterface
            {
                return new Response(...$this->responseData);
            }

            public function setResponseData(array $responseData): void
            {
                $this->responseData = $responseData;
            }
        };

        //

        $isDayOff = new IsDayOff($client);

        // 1. Expected Full Time

        $client->setResponseData([200, [], '0']);

        self::assertEquals(WorkType::SLUG_FULL_TIME, $isDayOff->determine(new \DateTime()));

        // 2. Expected Not Work

        $client->setResponseData([200, [], '1']);

        self::assertEquals(WorkType::SLUG_WEEKEND, $isDayOff->determine(new \DateTime()));

        // 3. Expected Short Day

        $client->setResponseData([200, [], '2']);

        self::assertEquals(WorkType::SLUG_SHORT_DAY, $isDayOff->determine(new \DateTime()));

        // 4. Given Unexpected Status

        $client->setResponseData([200, [], '999']);

        self::expectException(GivenInCorrectStatus::class);

        $isDayOff->determine(new \DateTime());
    }
}
