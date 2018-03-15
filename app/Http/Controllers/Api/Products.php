<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Stock\Product\ProductCommandService;
use App\Services\Stock\Product\ProductQueryService;

class Products extends Controller
{
	public function __construct(ProductCommandService $product_command_service, ProductQueryService $product_query_service)
    {
        $this->product_command_service = $product_command_service;
        $this->product_query_service = $product_query_service;
    }

	public function index(Request $request)
    {
        return $this->product_query_service->getProducts($request);
    }

	public function create(Request $request)
    {
        return $this->product_command_service->initializeProduct($request);
    }

	public function store(Request $request)
    {
        return $this->product_command_service->createProduct($request);
    }

	public function show(Request $request, $id)
    {
        return $this->product_query_service->getProduct($id, $request);
    }

	public function update(Request $request, $id)
    {
        return $this->product_command_service->updateProduct($id, $request);
    }

	public function destroy($id)
    {
        return $this->product_command_service->destroyProduct($id);
    }

}
