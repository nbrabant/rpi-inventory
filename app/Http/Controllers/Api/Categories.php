<?php  namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Categories extends RestController
{
	const MODEL = Category::class;

	protected $validation = [
		'nom' 		=> 'required|string',
		'position' 	=> 'required|integer',
	];

}
