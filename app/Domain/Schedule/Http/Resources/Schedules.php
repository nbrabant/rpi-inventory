<?php

namespace App\Domain\Schedule\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Schedule\Services\ScheduleCommandService;
use App\Domain\Schedule\Services\ScheduleQueryService;

/**
 * @property ScheduleCommandService schedule_command_service
 * @property ScheduleQueryService schedule_query_service
 */
class Schedules extends Controller
{
    public function __construct(
        ScheduleCommandService $schedule_command_service, 
        ScheduleQueryService $schedule_query_service
    ) {
        $this->schedule_command_service = $schedule_command_service;
        $this->schedule_query_service = $schedule_query_service;
    }

    public function index(Request $request)
    {
        return $this->schedule_query_service->getSchedules($request);
    }

    public function create(Request $request)
    {
        return $this->schedule_command_service->initializeSchedule($request);
    }

    public function store(Request $request)
    {
        return $this->schedule_command_service->createSchedule($request);
    }

    public function show(Request $request, $id)
    {
        return $this->schedule_query_service->getSchedule($id, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->schedule_command_service->updateSchedule($id, $request);
    }

    public function destroy($id)
    {
        return $this->schedule_command_service->destroySchedule($id);
    }
}
