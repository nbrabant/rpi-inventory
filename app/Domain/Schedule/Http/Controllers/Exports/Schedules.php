<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Schedule\Events\CleanCart;
use App\Domain\Schedule\Events\ExportCart;
use App\Domain\Schedule\Http\Requests\ExportToCartRequest;
use App\Domain\Schedule\Services\ScheduleQueryService;
use App\Infrastructure\Http\Controllers\Controller;

class Schedules extends Controller
{
    /**
     * @var ScheduleQueryService $scheduleQueryService
     */
    private ScheduleQueryService $scheduleQueryService;

    /**
     * @param ScheduleQueryService $scheduleQueryService
     */
    public function __construct(
        ScheduleQueryService $scheduleQueryService
    ) {
        $this->scheduleQueryService = $scheduleQueryService;
    }

    /**
     * @param ExportToCartRequest $request
     * @return bool
     */
    public function cartlist(ExportToCartRequest $request): bool
    {
        CleanCart::dispatchIf($request->exportType === 'cleanexport');

        ExportCart::dispatch($this->scheduleQueryService->getAttachedProducts($request)->toJson());

        return true;
    }
}
