<?php

namespace App\Domain\Cart\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Cart\Services\CartCommandService;
use App\Domain\Cart\Services\CartQueryService;

/**
 * @property CartCommandService cart_command_service
 * @property CartQueryService cart_query_service
 */
class Carts extends Controller
{
    public function __construct(
        CartCommandService $cart_command_service, 
        CartQueryService $cart_query_service
    ) {
        $this->cart_command_service = $cart_command_service;
        $this->cart_query_service = $cart_query_service;
    }

    public function show(Request $request, $id)
    {
        return $this->cart_query_service->getCurrent($request);
    }

    public function update(Request $request, $id)
    {
        return $this->cart_command_service->updateCart($request);
    }
}
