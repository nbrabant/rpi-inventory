<?php

namespace App\Services\Schedule\Schedule;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Schedule\ScheduleRepository as Schedule;
use \Carbon\Carbon;

class ScheduleQueryService
{
    private $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    // @TODO : override index method to load actual week schedules

    public function getSchedules(Request $request)
    {
        $events = [[
            'title' =>  'test',
            'allDay' =>  true,
            'start' =>  Carbon::now()->format('Y-m-d\TH:i:s'), // 2018-07-06T21:19:47.179Z
            'end' =>  Carbon::now()->addDay()->format('Y-m-d\TH:i:s'),
        ], [
            'title' => 'another test',
            'start' => Carbon::now()->addDays(2)->format('Y-m-d\TH:i:s'),
            'end' => Carbon::now()->addDays(2)->addHours(2)->format('Y-m-d\TH:i:s'),
        ]];

        return compact('events');

        // return $this->schedule->getAll($request);
    }

    public function getSchedule($id, Request $request)
    {
        return $this->schedule->find($id, $request);
    }

}
