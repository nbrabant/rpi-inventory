<?php namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Consumptions extends RestController
{
    const MODEL = Product::class;

    protected $validation = [];

    public function index(Request $request)
    {
        return [];
    }
}
