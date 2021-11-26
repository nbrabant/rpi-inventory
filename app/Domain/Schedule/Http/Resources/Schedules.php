<?php

namespace App\Domain\Schedule\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Schedule\Http\Requests\ScheduleRequest;

use App\Domain\Schedule\Services\ScheduleCommandService;
use App\Domain\Schedule\Services\ScheduleQueryService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property ScheduleCommandService scheduleCommandService
 * @property ScheduleQueryService scheduleQueryService
 */
class Schedules extends Controller
{
    /**
     * @param ScheduleCommandService $scheduleCommandService
     * @param ScheduleQueryService $scheduleQueryService
     */
    public function __construct(
        ScheduleCommandService $scheduleCommandService,
        ScheduleQueryService $scheduleQueryService
    ) {
        $this->scheduleCommandService = $scheduleCommandService;
        $this->scheduleQueryService = $scheduleQueryService;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->scheduleQueryService->getSchedules($request);
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
        return $this->scheduleCommandService->initializeSchedule();
    }

    /**
     * @param ScheduleRequest $request
     * @return Model
     */
    public function store(ScheduleRequest $request): Model
    {
        return $this->scheduleCommandService->createSchedule($request);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Model
     */
    public function show(Request $request, string $id): Model
    {
        return $this->scheduleQueryService->getSchedule($id, $request);
    }

    /**
     * @param ScheduleRequest $request
     * @param int $id
     * @return Model
     */
    public function update(ScheduleRequest $request, int $id): Model
    {
        return $this->scheduleCommandService->updateSchedule($id, $request);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->scheduleCommandService->destroySchedule($id);
    }
}
