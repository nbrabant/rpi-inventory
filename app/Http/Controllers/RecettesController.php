<?php namespace App\Http\Controllers;

use Input;
use Image;
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

	public function show(Recette $recette) {

		return view('recettes.show', [
            'title'     => $recette->nom,
            'recette'	=> $recette
        ]);
	}

	public function add(Recette $recette, Request $request) {
		if($request->method() == 'POST') {
			$this->validate($request, [
                'nom'				=> 'required',
                'instructions'		=> 'required',
                'nombre_personnes'	=> 'required|integer',
                'temps_preparation'	=> 'integer',
                'temps_cuisson'		=> 'integer',
            ]);

			$values = $request->all();

			$recette = new Recette;
			$recette->nom				= $values['nom'];
			$recette->instructions		= $values['instructions'];
			$recette->nombre_personnes	= $values['nombre_personnes'];
			$recette->temps_preparation	= $values['temps_preparation'];
			$recette->temps_cuisson		= $values['temps_cuisson'];

			// @TODO : produits

			if($recette->save()) {
				if(strlen($values['visuel']) > 0 && Input::file()) {
					$image = Input::file('visuel');
					$filename  = $recette->id.'.'.$image->getClientOriginalExtension();
					$path = public_path('recettes/'.$filename);
					Image::make($image->getRealPath())->resize(200, 200)->save($path);
	                $recette->visuel = $values['visuel'];
	                $recette->save();
				}

                return redirect(url('recettes'))->with('success', 'Recette créée');
            }
		}

		return view('recettes.add', [
            'title'			=> 'Ajout d\'une recette',
			'js_files'		=> ['plugins/ckeditor/ckeditor.js', 'recettes.js']
        ]);
	}

	public function edit(Recette $recette, Request $request) {
		if(is_null($recette) || !($recette instanceof Recette)) {
            return redirect('recettes')->with('message', 'Ligne introuvable');
        }

		if($request->method() == 'POST') {
			$this->validate($request, [
                'nom'				=> 'required',
                'instructions'		=> 'required',
                'nombre_personnes'	=> 'required|integer',
                'temps_preparation'	=> 'integer',
                'temps_cuisson'		=> 'integer',
            ]);

			$values = $request->all();

			$recette->nom				= $values['nom'];
			$recette->instructions		= $values['instructions'];
			$recette->nombre_personnes	= $values['nombre_personnes'];
			$recette->temps_preparation	= $values['temps_preparation'];
			$recette->temps_cuisson		= $values['temps_cuisson'];

			// @TODO : produits

			if(strlen($values['visuel']) > 0 && Input::file()) {
				$image = Input::file('visuel');
				$filename  = $recette->id.'.'.$image->getClientOriginalExtension();
				$path = public_path('img/recettes/'.$filename);
				Image::make($image->getRealPath())->resize(200, 200)->save($path);
                $recette->visuel = $values['visuel'];
			}

			if($recette->save()) {
                return redirect(url('recettes'))->with('success', 'Recette mise à jour');
            }
		}

		return view('recettes.edit', [
            'title'		=> 'Edition d\'une recette',
			'js_files'	=> ['plugins/ckeditor/ckeditor.js', 'recettes.js'],
			'recette'   => $recette
        ]);
	}

}
