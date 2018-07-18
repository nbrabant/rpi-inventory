<?php

namespace App\Services\Schedule\Schedule;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Schedule\ScheduleRepository as Schedule;
use Validator;

class ScheduleCommandService
{
    private $schedule;

    protected $validation = [

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
