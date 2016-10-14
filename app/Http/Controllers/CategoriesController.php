<?php  namespace App\Http\Controllers;

use App\Categorie;
use App\Produit;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

	/* liste catégories */
	public function index(Categorie $categorie)
	{
		return $this->getView('categories.index', [
			'title'     	=> 'Catégories',
			'breadcrumb'	=> [
				'Accueil' => url()
			],
			'btnHeading'	=> [
				'Ajouter' => '<a href="/categories/add" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>'
			],
			'categories'	=> $categorie->byPosition()->get(),
			'js_files'		=> ['category.js']
		]);
	}

	/* produits de la catégorie */
	public function show(Categorie $categorie)
	{
		return $this->getView('categories.show', [
			'title'     => 'Catégorie : '.$categorie->nom,
			'breadcrumb'	=> [
				'Accueil' => url(),
				'Agenda'  => url().'/recettes',
			],
			'categorie'	=> $categorie,
			'produits'	=> Produit::where('categorie_id', $categorie->id)->get()
		]);
	}

	public function add(Categorie $categorie, Request $request)
	{
		if($request->method() == 'POST') {
			//if validation fails, validate returns an exception and route on the view
			$this->validate($request, $categorie->getValidators());

			$values = $request->all();

			$categorie->nom = $values['nom'];
			if(($categorie->save())) {
				return redirect(url('categories'))->with('success', 'Données mises à jour');
			}
		}

		return $this->getView('categories.add', [
			'title'         => 'Ajout d\'une catégorie',
			'breadcrumb'	=> [
				'Accueil' => url(),
				'Catégories'  => url().'/categories',
			],
		]);
	}

	public function edit(Categorie $categorie, Request $request)
	{
		if($request->method() == 'POST') {
			$this->validate($request, $categorie->getValidators());

			$values = $request->all();

			$categorie->nom = $values['nom'];
			if(($categorie->save())) {
				return redirect(url('categories'))->with('success', 'Données mises à jour');
			}
		}

        return $this->getView('categories.edit', [
            'title'         => 'Edition d\'une catégorie',
			'breadcrumb'	=> [
				'Accueil' => url(),
				'Catégories'  => url().'/categories',
			],
            'categorie'     => $categorie
        ]);
    }

	public function sortlist(Request $request)
	{
		//$request->positions = categorie[]=1&categorie[]=10&categorie[]=9&categorie[]=8&categorie[]=11
		$positions = explode('&', str_replace('categorie[]=', '', json_decode($request->positions)));
		foreach ($positions as $position => $categorieID) {
			Categorie::find($categorieID)->update(array('position' => $position));
		}
		return response()->json(['status' => true]);
	}

}
