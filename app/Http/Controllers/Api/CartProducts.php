<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Cart\CartCommandService;
use App\Services\Cart\CartQueryService;

class CartProducts extends Controller
{
    public function __construct(
        CartCommandService $cart_command_service, 
        CartQueryService $cart_query_service
    ) {
        $this->cart_command_service = $cart_command_service;
        $this->cart_query_service = $cart_query_service;
    }

    public function store(Request $request)
    {
        return $this->cart_command_service->attachProduct($request);
    }

    public function update(Request $request, $id)
    {
        return $this->cart_command_service->updateProduct($request, $id);
    }

    public function destroy(Request $request, $product_id)
    {
        return $this->cart_command_service->removeProduct($request, $product_id);
    }
}
