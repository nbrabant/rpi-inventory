<?php

namespace App\Domain\Schedule\Repositories;

use App\Domain\Schedule\Entities\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{
    protected $perPage = 300; // @TODO : après transmission, récupération par date sans limite

    /**
     * Return repository entity model used
     *
     * @return string
     */
    public function model(): string
    {
        return Schedule::class;
    }

    /**
	 * Initialize new Eloquent model
	 *
	 * @return Schedule
	 */
    public function initialize(): Schedule
    {
        return new $this->model([
            'user_id'   => 1,
            'start_at'  => Carbon::now(),
            'end_at'    => Carbon::now(),
            'all_day'   => false,
        ]);
    }

    /**
     * Retrieve all recipe from Context
     *
     * @param Request $request
     * @return void
     */
    public function getAllRecipes(Request $request)
    {
        return $this->model->query()
            ->byDateInterval($request['dateRange'])
            ->whereTypeSchedule('recette')
            ->get();
    }
}
