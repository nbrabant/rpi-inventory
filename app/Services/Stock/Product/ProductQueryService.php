<?php

namespace App\Services\Stock\Product;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Stock\ProductRepository as Product;

class ProductQueryService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProducts(Request $request)
    {
        return $this->product->getAll($request);
    }

    public function getProduct($id, Request $request)
    {
        return $this->product->find($id, $request);
    }

    public function getProductWithConsumptions($id, Request $request)
    {
        $this->product->setWithRelation('operations');

        return $this->product->find($id, $request);
    }

}
