<?php

namespace App\Domain\Schedule\Http\Controllers\Exports;

use App\Domain\Schedule\Services\ScheduleQueryService;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Cart\Services\CartCommandService;

class Schedules extends Controller
{
    /**
     * @var CartCommandService
     */
    private $cart_command_service;
    /**
     * @var ScheduleQueryService
     */
    private $schedule_query_service;

    public function __construct(
        CartCommandService $cart_command_service,
        ScheduleQueryService $schedule_query_service
    ) {
        $this->cart_command_service = $cart_command_service;
        $this->schedule_query_service = $schedule_query_service;
    }

    public function cartlist(Request $request)
    {
        return $this->cart_command_service->addProductFromRecipes(
            $request,
            $this->schedule_query_service->getAttachedRecipes($request)
        );
    }
}
