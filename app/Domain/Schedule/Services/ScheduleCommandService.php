<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Requests\ScheduleRequest;

/**
 * @property ScheduleRepositoryInterface $scheduleRepository
 */
class ScheduleCommandService
{
    /**
     * Create Schedule Command Service instance.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @return Model
     */
    public function initializeSchedule(): Model
    {
        return $this->scheduleRepository->initialize();
    }

    /**
     * @param ScheduleRequest $request
     * @return Model
     */
    public function createSchedule(ScheduleRequest $request): Model
    {
        $attributes = $request->validated();

        return $this->scheduleRepository->create($attributes);
    }

    /**
     * @param int $id
     * @param ScheduleRequest $request
     * @return Model
     */
    public function updateSchedule(int $id, ScheduleRequest $request): Model
    {
        return $this->scheduleRepository
            ->update($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroySchedule(int $id): int
    {
        return $this->scheduleRepository->destroy($id);
    }

}
