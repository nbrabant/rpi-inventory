<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Stock\Product\ProductCommandService;
use App\Services\Stock\Product\ProductQueryService;

class Consumptions extends Controller
{
    public function __construct(ProductCommandService $product_command_service, ProductQueryService $product_query_service)
    {
        $this->product_command_service = $product_command_service;
        $this->product_query_service = $product_query_service;
    }

    public function index(Request $request)
    {
        return [];
    }
    
}
