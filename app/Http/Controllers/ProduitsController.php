<?php namespace App\Http\Controllers;

use App\Produit;
use App\Categorie;
use App\Operation;
use App\Liste;
use App\Ligneproduit;
use Illuminate\Http\Request;

class ProduitsController extends Controller {

    public function index(Produit $produit) {
        return view('produits.index', [
            'title'     => 'Administration des produits',
            'produits'  => $produit->all(),
            'categories'  => Categorie::byPosition()->get()
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

	public function addToCart(Produit $produit, Request $request) {
		$currentListe = Liste::firstOrCreate(['termine' => 0]);

		// produit présent danns liste de course?
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
		return view('consomation.index', [
			'title'       => 'Etat des consomations',

		]);
	}

	public function consomationDetails(Produit $produit, Request $request)
	{
		$return = view('consomation.productdetails', [
			'title'			=> 'Produit : '.$produit->nom,
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
