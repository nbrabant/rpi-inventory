<?php

namespace App\Http\Controllers\Exports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Schedule\Schedule\ScheduleQueryService;
use App\Services\Cart\CartCommandService;

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
