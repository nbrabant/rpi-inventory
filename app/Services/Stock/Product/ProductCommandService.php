<?php

namespace App\Services\Stock\Product;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Stock\ProductRepository as Product;
use App\Repositories\Stock\OperationRepository as Operation;
use Validator;

class ProductCommandService
{
    private $product;

    private $operation;

    protected $validation = [
        'category_id'	=> 'required|integer',
		'name' 			=> 'required|string|unique:products,name',
		'description'	=> 'required|string',
		'min_quantity'	=> 'required|integer',
		'unit'			=> 'string|in:piece,grammes,litre,sachet',
	];

    public function __construct(Product $product, Operation $operation)
    {
        $this->product = $product;
        $this->operation = $operation;
    }

    public function initializeProduct(Request $request)
    {
        return $this->product->initialize();
    }

    public function createProduct(Request $request)
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->product->create($attributes);
    }

    public function updateProduct($id, Request $request)
    {
        $this->validation['name'] .= ',' . $id;

        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->product->update($attributes, $id);
    }

    public function destroyProduct($id)
    {
        return $this->product->destroy($id);
    }

    public function initializeOperation(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $operation = $this->operation->initialize();

        $operation->fill($request->only('product_id'));

        return $operation;
    }

    public function saveOperation(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'operation' => 'required|in:+,-',
            'detail' => 'string',
        ]);

        $attributes = $request->only([
            'product_id',
            'quantity',
            'operation',
            'detail',
        ]);

        return $this->operation->create($attributes);
    }

}
