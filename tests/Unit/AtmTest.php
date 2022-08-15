<?php

namespace Tests\Unit;

use App\Services\AtmService;
use PHPUnit\Framework\TestCase;

class AtmTest extends TestCase
{
    /**
     * @return void
     */
    public function test_vip_customer(): void
    {
        $expected = 0;
        $dateTime = '2022-07-14 00:00:00';
        $atmService = new AtmService($dateTime, true);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_vip_customer');
    }

    /**
     * @return void
     */
    public function test_weekend(): void
    {
        $expected = 110;
        $dateTime = '2022-07-18 00:00:00';
        $atmService = new AtmService($dateTime);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_weekend');
    }

    /**
     * @return void
     */
    public function test_holiday(): void
    {
        $expected = 110;
        $dateTime = '2022-07-18 09:00:00';
        $atmService = new AtmService($dateTime);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_holiday');
    }

    /**
     * @return void
     */
    public function test_normal_day_1(): void
    {
        $expected = 110;
        $dateTime = '2022-07-14 00:00:00';
        $atmService = new AtmService($dateTime);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_normal_day_1');
    }

    /**
     * @return void
     */
    public function test_normal_day_2(): void
    {
        $expected = 110;
        $dateTime = '2022-07-14 18:00:00';
        $atmService = new AtmService($dateTime);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_normal_day_2');
    }

    /**
     * @return void
     */
    public function test_normal_day_3(): void
    {
        $expected = 0;
        $dateTime = '2022-07-14 17:00:00';
        $atmService = new AtmService($dateTime);
        $actual = $atmService->getFee();
        $this->assertEquals($expected, $actual, 'test_normal_day_3');
    }
}
