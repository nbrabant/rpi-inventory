<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Schedule\Services\ScheduleQueryService;
use Illuminate\Http\Request;
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

    public function cartlist(Request $request)
    {
        return $this->cartCommandService->addProductFromRecipes(
            $request,
            $this->scheduleQueryService->getAttachedRecipes($request)
        );
    }
}
