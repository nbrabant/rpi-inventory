<?php

namespace App\Repositories\Schedule;

use Carbon\Carbon;
use App\Repositories\Repository;
use \App\Models\Schedule as Schedule;

class ScheduleRepository extends Repository
{
    public function model() {
        return \App\Models\Schedule::class;
    }

    public function initialize()
    {
        return new $this->model();
    }


}
