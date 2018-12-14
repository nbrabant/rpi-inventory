<?php namespace App\Http\Controllers\Api;

use App\Models\Operation;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Operations extends RestController
{
    const MODEL = Operation::class;

    protected $validation = [
        'produit_id'	=> 'required|integer',
        'quantite'		=> 'required|integer',
        'operation'		=> 'required|string',
        'detail'		=> 'required|string',
    ];
}
