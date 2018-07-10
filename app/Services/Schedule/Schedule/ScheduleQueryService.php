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
        return $this->schedule->getAll($request);
    }

    public function getSchedule($id, Request $request)
    {
        return $this->schedule->find($id, $request);
    }

}
