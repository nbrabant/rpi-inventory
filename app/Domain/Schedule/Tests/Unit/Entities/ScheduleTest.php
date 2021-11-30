<?php

namespace App\Domain\Schedule\Tests\Unit\Entities;

use App\Domain\Schedule\Entities\Schedule;
use PHPUnit\Framework\TestCase;

class ScheduleTest extends TestCase
{
    /**
     * Test correct color for schedule
     *
     * @dataProvider scheduleTypeProvider
     *
     * @param string $scheduleType
     * @param string $expected
     */
    public function testScheduleTypeReturnDefinedColor(string $scheduleType, string $expected)
    {
        $schedule = new Schedule([
            'type_schedule' => $scheduleType
        ]);

        self::assertEquals($expected, $schedule->color);
    }

    public function scheduleTypeProvider(): array
    {
        return [
            ['recette', '#330000'],
            ['rendezvous', '#003300'],
            ['planning', '#000033'],
            ['other', '#000000'],
        ];
    }
}