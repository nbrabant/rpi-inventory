<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Requests\ScheduleRequest;

class ScheduleCommandService
{
    /**
     * @var ScheduleRepositoryInterface $scheduleRepository
     */
    private ScheduleRepositoryInterface $scheduleRepository;

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
     * @param $id
     * @param ScheduleRequest $request
     * @return Model
     */
    public function updateSchedule($id, ScheduleRequest $request): Model
    {
        $attributes = $request->validated();

        $schedule = $this->scheduleRepository->update($attributes, $id);

        return $schedule;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroySchedule($id): int
    {
        return $this->scheduleRepository->destroy($id);
    }

}
