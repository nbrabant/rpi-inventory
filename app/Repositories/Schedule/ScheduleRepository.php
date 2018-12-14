<?php

namespace App\Repositories\Schedule;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Repository;
use \App\Models\Schedule as Schedule;

class ScheduleRepository extends Repository
{
    protected $perPage = 300; // @TODO : après transmission, récupération par date sans limite

    public function model()
    {
        return \App\Models\Schedule::class;
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
