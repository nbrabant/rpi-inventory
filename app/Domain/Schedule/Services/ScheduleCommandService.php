<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use Validator;

class ScheduleCommandService
{
    /** @var ScheduleRepositoryInterface $scheduleRepository */
    private ScheduleRepositoryInterface $scheduleRepository;

    protected $validation = [
        'recipe_id'     => 'required_if:type_schedule,recette,numeric',
        'user_id'       => 'numeric',
        'type_schedule' => 'required|in:recette,rendezvous,planning',
        'title'         => 'required|string',
        'details'       => 'string',
        'start_at'      => 'required|date_format:Y-m-d H:i:s',
        'end_at'        => 'required|date_format:Y-m-d H:i:s',
        'all_day'       => 'required|boolean'
    ];

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
     * @param Request $request
     * @return Model
     */
    public function initializeSchedule(Request $request): Model
    {
        return $this->scheduleRepository->initialize();
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function createSchedule(Request $request): Model
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->scheduleRepository->create($attributes);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function updateSchedule($id, Request $request): Model
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

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
