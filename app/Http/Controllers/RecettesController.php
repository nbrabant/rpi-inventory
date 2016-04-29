<?php namespace App\Http\Controllers;

use Input;
use Image;
use App\Recette;
use App\RecetteProduit;
use Illuminate\Http\Request;

class RecettesController extends Controller
{
	private $js_files = ['plugins/ckeditor/ckeditor.js', 'recettes.js'];

	public function index(Recette $recette) {
        return view('recettes.index', [
            'title'     => 'Liste des recettes',
            'recettes'  => $recette->all()
        ]);
    }

	public function show(Recette $recette) {
		return view('recettes.show', [
            'title'     	=> $recette->nom,
            'recette'		=> $recette,
			'ingredients' 	=> $recette->produits
        ]);
	}

	public function add(Recette $recette, Request $request) {
		if($request->method() == 'POST') {
			$this->validate($request, $recette->getValidators());

			$values = $request->all();

			$recette = new Recette;
			$recette->nom				= $values['nom'];
			$recette->instructions		= $values['instructions'];
			$recette->nombre_personnes	= $values['nombre_personnes'];
			$recette->temps_preparation	= $values['temps_preparation'];
			$recette->temps_cuisson		= $values['temps_cuisson'];

			$lstProduits = array();
			if(isset($values['produits']) && is_array($values['produits']) && !empty($values['produits']))
			{
				foreach ($values['produits'] as $produitId) {
					if(!isset($values['quantite_'.$produitId])) {
						continue;
					}

					$lstProduits[] = new RecetteProduit([ 'produit_id' => $produitId, 'quantite' => $values['quantite_'.$produitId] ]);
				}
			}

			if($recette->save()) {
				if(isset($values['visuel']) && strlen($values['visuel']) > 0 && Input::file()) {
					$image = Input::file('visuel');
					$filename  = $recette->id.'.'.$image->getClientOriginalExtension();
					$path = public_path('recettes/'.$filename);
					Image::make($image->getRealPath())->resize(200, 200)->save($path);
	                $recette->visuel = $values['visuel'];
	                $recette->save();
				}

				if(is_array($lstProduits) && !empty($lstProduits)) {
					$recette->produits()->saveMany( $lstProduits );
				}

                return redirect(url('recettes'))->with('success', 'Recette créée');
            }
		}

		return view('recettes.add', [
            'title'			=> 'Ajout d\'une recette',
			'js_files'		=> ['plugins/ckeditor/ckeditor.js', 'ckediitor_init.js']
        ]);
	}

	public function edit(Recette $recette, Request $request) {
		if(is_null($recette) || !($recette instanceof Recette)) {
            return redirect('recettes')->with('message', 'Ligne introuvable');
        }

		if($request->method() == 'POST') {
			$this->validate($request, $recette->getValidators());

			$values = $request->all();

			$recette->nom				= $values['nom'];
			$recette->instructions		= $values['instructions'];
			$recette->nombre_personnes	= $values['nombre_personnes'];
			$recette->temps_preparation	= $values['temps_preparation'];
			$recette->temps_cuisson		= $values['temps_cuisson'];

			if(isset($values['visuel']) && strlen($values['visuel']) > 0 && Input::file()) {
				$image = Input::file('visuel');
				$filename  = $recette->id.'.'.$image->getClientOriginalExtension();
				$path = public_path('img/recettes/'.$filename);
				Image::make($image->getRealPath())->resize(200, 200)->save($path);
                $recette->visuel = $values['visuel'];
			}

			$lstProduits = array();
			if(isset($values['produits']) && is_array($values['produits']) && !empty($values['produits']))
			{
				foreach ($values['produits'] as $produitId) {
					if(!isset($values['quantite_'.$produitId]) || $values['quantite_'.$produitId] <= 0) {
						continue;
					}

					$lstProduits[] = new RecetteProduit([ 'produit_id' => $produitId, 'quantite' => $values['quantite_'.$produitId] ]);
				}
			}

			if(is_array($lstProduits) && !empty($lstProduits)) {
				$recette->produits()->saveMany( $lstProduits );
			}

			if($recette->save() ) {
                return redirect(url('recettes'))->with('success', 'Recette mise à jour');
            }
		}

		return view('recettes.edit', [
            'title'		=> 'Edition d\'une recette',
			'js_files'	=> ['plugins/ckeditor/ckeditor.js', 'ckediitor_init.js'],
			'recette'   => $recette
        ]);
	}

	public function recherche(Recette $recette, Request $request)
	{
		return view('recettes.recherche', [
            'title' 	=> 'Rechercher une recette 750g.com',
			'js_files' 	=> ['recettes.js']
        ]);
	}

	public function apisearch(Recette $recette, Request $request)
	{
		$recipes = $recette->getApiRecettes($request->ingredients);

		return response()->json([
			'status' => true,
			'html' => view('recettes.searchresult', ['recipes' => $recipes])->render()
		]);
	}
}
