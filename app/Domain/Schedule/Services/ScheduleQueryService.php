<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ScheduleQueryService
{
    /** @var ScheduleRepositoryInterface $scheduleRepository */
    private ScheduleRepositoryInterface $scheduleRepository;

    /**
     * Create Schedule Query Service instance.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getSchedules(Request $request): LengthAwarePaginator
    {
        return $this->scheduleRepository->getAll($request);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function getSchedule($id, Request $request): Model
    {
        return $this->scheduleRepository->find($id, $request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAttachedRecipes(Request $request)
    {
        return $this->scheduleRepository->getAllRecipes($request)->map(function ($schedule) {
            return $schedule->recipe;
        });
    }
}
