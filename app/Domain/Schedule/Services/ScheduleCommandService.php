<?php

namespace App\Domain\Schedule\Services;

use Illuminate\Http\Request;
use App\Domain\Schedule\Repositories\ScheduleRepository as Schedule;
use Validator;

class ScheduleCommandService
{
    private $schedule;

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

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function initializeSchedule(Request $request)
    {
        return $this->schedule->initialize();
    }

    public function createSchedule(Request $request)
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->schedule->create($attributes);
    }

    public function updateSchedule($id, Request $request)
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        $schedule = $this->schedule->update($attributes, $id);

        return $schedule;
    }

    public function destroySchedule($id)
    {
        return $this->schedule->destroy($id);
    }
}
