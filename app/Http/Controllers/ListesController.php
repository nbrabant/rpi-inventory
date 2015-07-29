<?php namespace App\Http\Controllers;

use App\Produit;
use App\Liste;
use App\Ligneproduit;
use App\Operation;
use Illuminate\Http\Request;

class ListesController extends Controller {

	public $currentListe = null;
	
	public function __construct() {
		// récup first liste non terminée, si !liste -> create
		$this->currentListe = Liste::firstOrCreate(['termine' => 0]);
	}
	
	public function index() {
        return view('listes.index', [
            'title'		=> 'Liste de courses',
            'liste'		=> $this->currentListe,
            'produits'	=> Produit::getOutOfStockProducts($this->currentListe->getProductListIds()),
        ]);
    }

	public function ajoutproduits(Request $request) {
		if($request->method() == 'POST') {
			$values = $request->all();
			if(!isset($values['produits']) || !is_array($values['produits']) || empty($values['produits'])) {
				return redirect(url('liste-courses'));
			}
			
			$lstProduits = []; // Collection d'objets liste-produits
			foreach ($values['produits'] as $produitId) {
				$produit = Produit::find($produitId);
				if(is_null($produit) || !($produit instanceof Produit)) {
					continue;
				}
				$lstProduits[] = new Ligneproduit([ 'produit_id' => $produit->id, 'quantite' => 1 ]);
			}

			if(is_array($lstProduits) && !empty($lstProduits)) {
				$this->currentListe->lignesproduits()->saveMany( $lstProduits );
			}
		}
		return redirect(url('liste-courses'));
	}

	public function deleteproduits($id) {
		$ligneProduit = $this->currentListe->lignesproduits()->whereId($id)->first();
		if(is_null($ligneProduit) || !($ligneProduit instanceof Ligneproduit) || !$ligneProduit->delete()) {
			
		}
		return redirect(url('liste-courses'));
	}

	public function endinglist() {
		// nouvelles opération sur le produit
		foreach ($this->currentListe->lignesproduits as $ligneproduit) {
			Operation::create([
				'produit_id'	=> $ligneproduit->produit_id,
				'quantite'		=> $ligneproduit->quantite,
				'operation'		=> '+',
				'detail'		=> 'Retour de courses du '
			]);
		}

		// passage de la liste courante à terminé + save + redirect en homepage
		$this->currentListe->termine = 1;
		$this->currentListe->save();
		return redirect(url('/'));
	}
}
