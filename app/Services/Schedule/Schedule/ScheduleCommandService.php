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

    public function destroySchedule($id)
    {
        return $this->schedule->destroy($id);
    }
}
