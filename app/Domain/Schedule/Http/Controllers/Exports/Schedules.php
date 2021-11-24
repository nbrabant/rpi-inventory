<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Requests\ExportCartRequest;
use App\Domain\Schedule\Services\ScheduleQueryService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Cart\Services\CartCommandService;

/**
 * @property CartCommandService $cartCommandService
 * @property ScheduleQueryService $scheduleQueryService
 */
class Schedules extends Controller
{
    /**
     * @param CartCommandService $cartCommandService
     * @param ScheduleQueryService $scheduleQueryService
     */
    public function __construct(
        CartCommandService $cartCommandService,
        ScheduleQueryService $scheduleQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->scheduleQueryService = $scheduleQueryService;
    }

    /**
     * @TODO : Recipe domain responsability - move to cart domain
     * @TODO: trigger event with associated products
     *
     * @param ExportCartRequest $request
     * @return CartInterface
     */
    public function cartlist(ExportCartRequest $request): CartInterface
    {
        return $this->cartCommandService->addProductFromRecipes(
            $request,
            $this->scheduleQueryService->getAttachedRecipes($request)
        );
    }
}
