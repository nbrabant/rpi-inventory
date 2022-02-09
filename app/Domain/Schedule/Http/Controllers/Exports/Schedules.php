<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Http\Requests\ExportCartRequest;
use App\Domain\Schedule\Services\ScheduleQueryService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Cart\Services\CartCommandService;

class Schedules extends Controller
{
    /**
     * @var CartCommandService $cartCommandService
     */
    private CartCommandService $cartCommandService;
    /**
     * @var ScheduleQueryService $scheduleQueryService
     */
    private ScheduleQueryService $scheduleQueryService;

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
