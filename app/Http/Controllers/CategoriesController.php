<?php  namespace App\Http\Controllers;

use App\Categorie;
use App\Produit;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

	/* liste catégories */
	public function index(Categorie $categorie) {
		return view('categories.index', [
			'title'     => 'Catégories',
			'categories'=> $categorie->byPosition()->get()
		]);
	}

	/* produits de la catégorie */
	public function show(Categorie $categorie) {
		return view('categories.show', [
			'title'     => 'Catégorie : '.$categorie->nom,
			'categorie'	=> $categorie,
			'produits'	=> Produit::where('categorie_id', $categorie->id)->get()
		]);
	}

	public function add(Categorie $categorie, Request $request) {
		if($request->method() == 'POST') {
			//if validation fails, validate returns an exception and route on the view
			$this->validate($request, [
				'nom' => 'required',
				'position' => 'required',
			]);

			$values = $request->all();

			$categorie->nom = $values['nom'];
			if(($categorie->save())) {
				return redirect(url('categories'))->with('success', 'Données mises à jour');
			}
		}

		return view('categories.add', [
			'title'         => 'Ajout d\'une catégorie'
		]);
	}

	public function edit(Categorie $categorie, Request $request) {
		if($request->method() == 'POST') {
			$this->validate($request, [
				'nom' => 'required',
				'position' => 'required',
			]);

			$values = $request->all();

			$categorie->nom = $values['nom'];
			if(($categorie->save())) {
				return redirect(url('categories'))->with('success', 'Données mises à jour');
			}
		}

        return view('categories.edit', [
            'title'         => 'Edition d\'une catégorie',
            'categorie'     => $categorie,
        ]);
    }
}
