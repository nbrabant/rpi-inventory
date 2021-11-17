<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Cart\Requests\ExportCartRequest;
use App\Domain\Schedule\Services\ScheduleQueryService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Cart\Services\CartCommandService;

class Schedules extends Controller
{
    /**
     * @var CartCommandService $cartCommandService
     */
    private $cartCommandService;
    /**
     * @var ScheduleQueryService $scheduleQueryService
     */
    private $scheduleQueryService;

    public function __construct(
        CartCommandService $cartCommandService,
        ScheduleQueryService $scheduleQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->scheduleQueryService = $scheduleQueryService;
    }

    /**
     * @warning: Schedule single responsability
     * @todo: trigger event with associated products
     *
     * @param ExportCartRequest $request
     * @return \App\Domain\Cart\Contracts\CartInterface
     */
    public function cartlist(ExportCartRequest $request)
    {
        return $this->cartCommandService->addProductFromRecipes(
            $request,
            $this->scheduleQueryService->getAttachedRecipes($request)
        );
    }
}
