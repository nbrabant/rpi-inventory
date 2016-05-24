<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Recette;
use Illuminate\Http\Request;

class AgendasController extends Controller
{
	public function index(Categorie $categorie)
	{
		return view('agendas.index', [
			'title'     	=> 'Agendas',
			// 'js_files'		=> ['category.js']
		]);
	}
}
