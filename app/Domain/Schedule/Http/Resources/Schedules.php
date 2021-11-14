<?php

namespace App\Domain\Schedule\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Schedule\Services\ScheduleCommandService;
use App\Domain\Schedule\Services\ScheduleQueryService;

/**
 * @property ScheduleCommandService scheduleCommandService
 * @property ScheduleQueryService scheduleQueryService
 */
class Schedules extends Controller
{
    public function __construct(
        ScheduleCommandService $scheduleCommandService,
        ScheduleQueryService $scheduleQueryService
    ) {
        $this->scheduleCommandService = $scheduleCommandService;
        $this->schedule_query_service = $scheduleQueryService;
    }

    public function index(Request $request)
    {
        return $this->scheduleQueryService->getSchedules($request);
    }

    public function create(Request $request)
    {
        return $this->scheduleCommandService->initializeSchedule($request);
    }

    public function store(Request $request)
    {
        return $this->scheduleCommandService->createSchedule($request);
    }

    public function show(Request $request, $id)
    {
        return $this->scheduleQueryService->getSchedule($id, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->scheduleCommandService->updateSchedule($id, $request);
    }

    public function destroy($id)
    {
        return $this->scheduleCommandService->destroySchedule($id);
    }
}
