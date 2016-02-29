<?php namespace App\Http\Controllers;

use App\Produit;
use App\Categorie;
use App\Operation;
use Illuminate\Http\Request;

class ProduitsController extends Controller {

    public function index(Produit $produit) {
        return view('produits.index', [
            'title'     => 'Administration des produits',
            'produits'  => $produit->all()
        ]);
    }

	/* Produit avec toutes les opérations d'entrée */
	public function show(Produit $produit, Request $request) {
		if($request->method() == 'POST') {
			//if validation fails, validate returns an exception and route on the view
            $this->validate($request, [
                'operation'		=> 'required',
                'quantite'		=> 'required',
            ]);

			$values = $request->all();

			$operation = new Operation;
			$operation->produit_id	= $produit->id;
			$operation->operation	= $values['operation'];
			$operation->quantite	= $values['quantite'];
			$operation->detail		= $values['detail'];
			if($operation->save()) {
                return redirect(url('produits/show/'.$produit->id))->with('success', 'Stock du produit mis à jour');
            }
		}

		return view('produits.show', [
			'title'			=> 'Produit : '.$produit->nom,
			'produit'		=> $produit,
			'operations'	=> $produit->operations()->orderBy('created_at', 'desc')->get()
		]);
	}

    public function add(Produit $produit, Request $request) {
        if($request->method() == 'POST') {
            //if validation fails, validate returns an exception and route on the view
            $this->validate($request, [
                'nom'			=> 'required',
                'quantite'		=> 'required',
                'quantite_min'	=> 'required',
            ]);

            $values = $request->all();

			//@TODO : ajouter une opération de type ajout
			$operation = new Operation;
			$operation->operation	= '+';
			$operation->quantite	= $values['quantite'];
			$operation->detail		= 'Première entrée';

            $produit = new Produit;
			$produit->categorie_id	= ($values['categorie_id'] > 0 ? $values['categorie_id'] : null);
            $produit->nom			= $values['nom'];
            $produit->description	= $values['description'];
            $produit->quantite_min	= (strlen($values['quantite_min']) > 0 ? $values['quantite_min'] : 0);

            if($produit->push() && $produit->operations()->save($operation)) {
                return redirect(url('produits'))->with('success', 'Données mises à jour');
            }
        }

        return view('produits.add', [
            'title'			=> 'Ajout d\'un produit',
            'categories'	=> Categorie::getList()
        ]);
    }

    public function edit(Produit $produit, Request $request) {
        if(is_null($produit) || !($produit instanceof Produit)) {
            return redirect('produits')->with('message', 'Ligne introuvable');
        }

        if($request->method() == 'POST') {
            $this->validate($request, [
				'nom'			=> 'required',
                'quantite_min'	=> 'required',
            ]);

            $values = $request->all();

			$produit->categorie_id	= ($values['categorie_id'] > 0 ? $values['categorie_id'] : null);
            $produit->nom			= $values['nom'];
            $produit->description	= $values['description'];
            $produit->quantite_min	= (strlen($values['quantite_min']) > 0 ? $values['quantite_min'] : 0);
			if($produit->save()) {
                return redirect(url('produits'))->with('success', 'Données mises à jour');
            }
        }

        return view('produits.edit', [
            'title'       => 'Edition d\'un produit',
            'categories'  => Categorie::getList(),
            'produit'     => $produit
        ]);
    }
}
