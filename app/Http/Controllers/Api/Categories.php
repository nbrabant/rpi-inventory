<?php  namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Categories extends RestController
{
	const MODEL = Category::class;

	protected $validation = [
		'nom' 		=> 'required|string',
		'position' 	=> 'required|integer',
	];

	/**
	 * @override create method
	 *
	 * @return Category object
	 */
	public function create()
    {
        $model = static::MODEL;

        return new $model(['position' => 255]);
    }

}
