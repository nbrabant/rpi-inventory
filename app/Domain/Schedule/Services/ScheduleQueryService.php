<?php

namespace App\Domain\Schedule\Services;

use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Entities\Dto\NeededProductsData;
use App\Domain\Schedule\Entities\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ScheduleQueryService
{
    /**
     * @var ScheduleRepositoryInterface $scheduleRepository
     */
    private ScheduleRepositoryInterface $scheduleRepository;

    /**
     * Create Schedule Query Service instance.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getSchedules(Request $request): LengthAwarePaginator
    {
        return $this->scheduleRepository->getAll($request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function getSchedule(string $id, Request $request): Model
    {
        return $this->scheduleRepository->find($id, $request);
    }

    /**
     * @param Request $request
     * @return NeededProductsData
     */
    public function getAttachedProducts(Request $request): NeededProductsData
    {
        return $this->scheduleRepository->getAllRecipes($request)
            ->map(function (Schedule $schedule) {
                return $schedule->recipe->products;
            })->reduce(function (NeededProductsData $neededProductsData, Collection $recipeProducts) {
                return $neededProductsData->addProducts($recipeProducts);
            }, new NeededProductsData([
                'products' => collect([])
            ]));
    }
}
