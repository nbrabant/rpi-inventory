<?php

namespace App\Services\Stock\Product;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Stock\ProductRepository as Product;
use Validator;

class ProductCommandService
{
    private $product;

    protected $validation = [
        'categorie_id'	=> 'required|integer',
		'nom' 			=> 'required|string|unique:produits,nom',
		'description'	=> 'required|string',
		'quantite_min'	=> 'required|integer',
		'unite'			=> 'string|in:piece,grammes,litre,sachet',
	];

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function initializeProduct(Request $request)
    {
        return $this->product->initialize();
    }

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validation);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        $attributes = $request->only(array_keys($this->validation));

        return $this->product->create($attributes);
    }

    public function updateProduct($id, Request $request)
    {
        $this->validation['nom'] .= ',' . $id;

        $validator = Validator::make($request->all(), $this->validation);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        $attributes = $request->only(array_keys($this->validation));

        return $this->product->update($attributes, $id);
    }

    public function destroyProduct($id)
    {
        return $this->product->destroy($id);
    }

}
