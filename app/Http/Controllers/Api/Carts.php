<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Cart\CartCommandService;
use App\Services\Cart\CartQueryService;

class Carts extends Controller
{
    public function __construct(CartCommandService $cart_command_service, CartQueryService $cart_query_service)
    {
        $this->cart_command_service = $cart_command_service;
        $this->cart_query_service = $cart_query_service;
    }

    public function create(Request $request)
    {
        return [];
    }

    public function show(Request $request, $id)
    {
        return $this->cart_query_service->getCurrent($request);
    }

}
