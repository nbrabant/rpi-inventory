<?php namespace App\Http\Controllers;

use App\Recette;
use Illuminate\Http\Request;

class RecettesController extends Controller
{
	public function index(Recette $recette) {
        return view('recettes.index', [
            'title'     => 'Liste des recettes',
            'recettes'  => $recette->all()
        ]);
    }

	public function add(Recette $recette, Request $request) {
		if($request->method() == 'POST') {
			$this->validate($request, [
                'nom'				=> 'required',
                'instructions'		=> 'required',
                'nombre_personnes'	=> 'required',
            ]);

			$values = $request->all();

			var_dump($values); exit;


		}

		return view('recettes.add', [
            'title'			=> 'Ajout d\'une recette',
			'js_files'		=> ['plugins/ckeditor/ckeditor.js', 'recettes.js']
        ]);
	}

	public function edit(Recette $recette, Request $request) {

	}

}
