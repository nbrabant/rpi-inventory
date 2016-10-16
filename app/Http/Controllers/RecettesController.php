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
        return $this->getView('recettes.index', [
            'title'     => 'Liste des recettes',
			'breadcrumb'	=> [
				'Accueil' => url()
			],
			'btnHeading'	=> [
				'Ajouter' => '<a href="/recettes/add" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>'
			],
			'linkHeading'	=> [
				'plus' => '/recettes/add'
			],
            'recettes'  => $recette->all()
        ]);
    }

	public function show(Recette $recette) {
		return $this->getView('recettes.show', [
            'title'     	=> $recette->nom,
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Recettes' => url().'/recettes',
			],
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
			$recette->complement		= isset($values['complement']) ? $values['complement'] : null;

			if($recette->save()) {
				if(isset($values['visuel']) && strlen($values['visuel']) > 0 && Input::file()) {
					$image = Input::file('visuel');
					$filename  = $recette->id.'.'.$image->getClientOriginalExtension();
					$path = public_path().'/img/recettes/'.$filename;
					Image::make($image->getRealPath())->resize(200, 200)->save($path);
	                $recette->visuel = $filename;
	                $recette->save();
				} elseif (isset($values['imgurl']) && strlen($values['imgurl']) > 0) {
					//@TODO : gestion non jpeg...
					$filepath = public_path().'/img/recettes/'.$recette->id;
					$result = Recette::getImageFromURL($values['imgurl'], $filepath);
					if($result['status'] == true) {
						$recette->visuel = $recette->id.'.'.$result['extension'];
		                $recette->save();
					}
				}

				$recette->syncProducts($values);

				if(isset($values['ajax']) && $values['ajax'] == true) {
					return response()->json(['status' => true]);
				}
                return redirect(url('recettes'))->with('success', 'Recette créée');
            }
		}

		return $this->getView('recettes.add', [
            'title'			=> 'Ajout d\'une recette',
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Recettes' => url().'/recettes',
			],
			'js_files'		=> ['plugins/ckeditor/ckeditor.js', 'ckediitor_init.js']
        ]);
	}

	public function edit(Recette $recette, Request $request) {
		if(is_null($recette) || !($recette instanceof Recette)) {
            return redirect('recettes')->with('message', 'Ligne introuvable');
        }

		// eager loading
		$recette->with('produits');

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
                $recette->visuel = $filename;
			}

			$recette->syncProducts($values);

			if($recette->save() ) {
                return redirect(url('recettes'))->with('success', 'Recette mise à jour');
            }
		}

		return $this->getView('recettes.edit', [
            'title'		=> 'Edition d\'une recette',
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Recettes' => url().'/recettes',
			],
			'js_files'	=> ['plugins/ckeditor/ckeditor.js', 'ckediitor_init.js'],
			'uniteList' => RecetteProduit::getUniteList(),
			'recette'   => $recette
        ]);
	}

	public function recherche(Recette $recette, Request $request)
	{
		return $this->getView('recettes.recherche', [
            'title' 	=> 'Rechercher une recette 750g.com',
			'breadcrumb'	=> [
				'Accueil' => url()
			],
			'js_files' 	=> ['recettes.js']
        ]);
	}

	public function apisearch(Recette $recette, Request $request)
	{
		$recipes = $recette->getApiRecettes($request->ingredients);

		return response()->json([
			'status' => true,
			'html' => $this->getView('recettes.searchresult', ['recipes' => $recipes])->render()
		]);
	}

	public function populaterecette(Recette $recette, Request $request)
	{
		return response()->json([
			'status' => true,
			'html' => $this->getView('recettes.populate', [
				'recipe' 	=> $recette->getDetailRecettes($request->url),
				'title'		=> 'Ajout d\'une recette',
				'uniteList' => RecetteProduit::getUniteList(),
				'js_files'	=> ['plugins/ckeditor/ckeditor.js', 'ckediitor_init.js']
			])->render()
		]);
	}
}
