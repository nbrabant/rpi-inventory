<?php namespace App\Http\Controllers;

use App\Produit;
use App\Categorie;
use App\Operation;
use App\Liste;
use App\Ligneproduit;
use Illuminate\Http\Request;

class ProduitsController extends Controller {

    public function index(Produit $produit) {
        return $this->getView('produits.index', [
            'title'     	=> 'Administration des produits',
			'breadcrumb'	=> [
				'Accueil' => url()
			],
			'btnHeading'	=> [
				'Ajouter' => '<a href="/produits/add" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>'
			],
            'produits'  	=> $produit->all(),
            'categories'  	=> Categorie::byPosition()->get()
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

		return $this->getView('produits.show', [
			'title'			=> $produit->nom,
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Produits' => url().'/produits',
			],
			'produit'		=> $produit,
			'operations'	=> $produit->operations()->orderBy('created_at', 'desc')->get()
		]);
	}

    public function add(Produit $produit, Request $request) {
        if($request->method() == 'POST') {
            //if validation fails, validate returns an exception and route on the view
            $this->validate($request, $produit->getValidators());

            $values = $request->all();

			$operation = new Operation;
			$operation->operation	= '+';
			$operation->quantite	= $values['quantite'];
			$operation->detail		= 'Première entrée';

            $produit = new Produit;
			$produit->categorie_id	= ($values['categorie_id'] > 0 ? $values['categorie_id'] : null);
            $produit->nom			= $values['nom'];
            $produit->description	= $values['description'];
            $produit->quantite_min	= (strlen($values['quantite_min']) > 0 ? $values['quantite_min'] : 0);
            $produit->unite			= (strlen($values['unite']) > 0 ? $values['unite'] : null);

            if($produit->push() && $produit->operations()->save($operation)) {
                return redirect(url('produits'))->with('success', 'Données mises à jour');
            }
        }

        return $this->getView('produits.add', [
            'title'			=> 'Ajout d\'un produit',
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Produits' => url().'/produits',
			],
            'categories'	=> Categorie::getList(),
			'uniteList'		=> $produit->getUniteList()
        ]);
    }

    public function edit(Produit $produit, Request $request) {
        if(is_null($produit) || !($produit instanceof Produit)) {
            return redirect('produits')->with('message', 'Ligne introuvable');
        }

        if($request->method() == 'POST') {
            $this->validate($request, $produit->getValidators());

            $values = $request->all();

			$produit->categorie_id	= ($values['categorie_id'] > 0 ? $values['categorie_id'] : null);
            $produit->nom			= $values['nom'];
            $produit->description	= $values['description'];
            $produit->quantite_min	= (strlen($values['quantite_min']) > 0 ? $values['quantite_min'] : 0);
            $produit->unite			= (strlen($values['unite']) > 0 ? $values['unite'] : null);
			if($produit->save()) {
                return redirect(url('produits'))->with('success', 'Données mises à jour');
            }
        }

        return $this->getView('produits.edit', [
            'title'			=> 'Edition d\'un produit',
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Produits' => url().'/produits',
			],
            'categories'	=> Categorie::getList(),
            'produit'   	=> $produit,
			'uniteList'		=> $produit->getUniteList()
        ]);
    }

	public function addToCart(Produit $produit, Request $request) {
		$currentListe = Liste::firstOrCreate(['termine' => 0]);

		// produit présent dans liste de course?
		$productLine = $currentListe->lignesproduits()->where('produit_id', $produit->id)->first();
		if(!is_null($productLine)) {
			$productLine->quantite += 1;
			$productLine->save();
			return redirect(url('produits'))->with('success', 'Nombre de produit mis à jour');
		}

		$newLine = new Ligneproduit([ 'produit_id' => $produit->id, 'quantite' => 1 ]);
		if($currentListe->lignesproduits()->save($newLine)) {
			return redirect(url('produits'))->with('success', 'Produit ajouté à la liste de courses');
		}
		return redirect(url('produits'))->with('error', 'Impossible d\'ajouter le produit à la liste de courses');
	}

	public function consomation(Request $request) {
		return $this->getView('consomation.index', [
			'title'       => 'Etat des consomations','breadcrumb'	=> [
				'Accueil'  => url(),
				'Produits' => url().'/produits',
			],
		]);
	}

	public function consomationDetails(Produit $produit, Request $request)
	{
		$return = $this->getView('consomation.productdetails', [
			'title'			=> 'Produit : '.$produit->nom,
			'breadcrumb'	=> [
				'Accueil'  => url(),
				'Produits' => url().'/produits',
				'Produits' => url().'/produits/'.$produit->id,
			],
			'produit' 		=> $produit,
			'operations'	=> $produit->operations()->orderBy('created_at', 'desc')->get()
		])->render();

		return response()->json([
			'status' => true,
			'html' => $return
		]);
	}

	public function autocomplete() {
		return View::make('autocomplete');
	}

	public function getProducts(Request $request) {
		$term = strtolower($request->term);
	    $return_array = array();

		$products = Produit::where('nom', 'LIKE', '%'.$term.'%')->get();
	    foreach ($products as $product) {
	        $return_array[] = array(
				'id' => $product->id,
				'value' => $product->nom,
			);
	    }
	    return response()->json($return_array);
	}
}
