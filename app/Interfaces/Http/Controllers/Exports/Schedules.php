<?php

namespace App\Interfaces\Http\Controllers\Exports;

use Illuminate\Http\Request;
use App\Interfaces\Http\Controllers\Controller;

use App\Services\Schedule\Schedule\ScheduleQueryService;
use App\Domain\Cart\Services\CartCommandService;

class Schedules extends Controller
{
    public function __construct(CartCommandService $cart_command_service, ScheduleQueryService $schedule_query_service)
    {
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
