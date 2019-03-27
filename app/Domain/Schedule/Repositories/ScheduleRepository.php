<?php

namespace App\Domain\Schedule\Repositories;

use App\Domain\Schedule\Entities\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Interfaces\Repositories\AbstractRepository;

class ScheduleRepository extends AbstractRepository
{
    protected $perPage = 300; // @TODO : après transmission, récupération par date sans limite

    public function model()
    {
        return Schedule::class;
    }

    public function initialize()
    {
        return new $this->model([
            'user_id'   => 1,
            'start_at'  => Carbon::now(),
            'end_at'    => Carbon::now(),
            'all_day'   => false,
        ]);
    }

    public function getAllRecipes(Request $request)
    {
        return $this->model->query()
            ->byDateInterval($request['dateRange'])
            ->whereTypeSchedule('recette')
            ->get();
    }
}
