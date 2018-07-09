<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Schedule\Schedule\ScheduleCommandService;
use App\Services\Schedule\Schedule\ScheduleQueryService;

class Schedules extends Controller
{
    public function __construct(ScheduleCommandService $schedule_command_service, ScheduleQueryService $schedule_query_service)
    {
        $this->schedule_command_service = $schedule_command_service;
        $this->schedule_query_service = $schedule_query_service;
    }

    public function index(Request $request)
    {
        return $this->schedule_query_service->getSchedules($request);
    }

}
