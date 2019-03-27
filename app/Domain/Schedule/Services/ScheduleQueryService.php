<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Http\Request;
use App\Domain\Schedule\Repositories\ScheduleRepository as Schedule;

class ScheduleQueryService
{
    private $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function getSchedules(Request $request)
    {
        return $this->schedule->getAll($request);
    }

    public function getSchedule($id, Request $request)
    {
        return $this->schedule->find($id, $request);
    }

    public function getAttachedRecipes(Request $request)
    {
        return $this->schedule->getAllRecipes($request)->map(function ($schedule) {
            return $schedule->recipe;
        });
    }
}
