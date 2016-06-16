<?php namespace App\Http\Controllers;

use App\Produit;
use App\Liste;
use App\Ligneproduit;
use App\Operation;
use App\Categorie;
use App\Agendaproducts;
use Illuminate\Http\Request;
use App\Trellomanager;

class ListesController extends Controller {

	public $currentListe = null;

	public function __construct() {
		// récup first liste non terminée, si !liste -> create
		$this->currentListe = Liste::firstOrCreate(['termine' => 0]);
	}

	public function index() {
        return view('listes-courses.index', [
            'title'			=> 'Liste de courses',
            'liste'			=> $this->currentListe,
            'produits'		=> Produit::getOutOfStockProducts($this->currentListe->getProductListIds()),
			'trello_token'	=> config('services.trello.client_token'),
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

				$ligneProduit = $this->currentListe->lignesproduits()->whereProduitId($produit->id)->first();
				if(isset($ligneProduit) && $ligneProduit instanceof Ligneproduit) {
					$ligneProduit->quantite++;
					$ligneProduit->save();
				} else {
					$lstProduits[] = new Ligneproduit([ 'produit_id' => $produit->id, 'quantite' => 1 ]);
				}
			}

			if(is_array($lstProduits) && !empty($lstProduits)) {
				$this->currentListe->lignesproduits()->saveMany( $lstProduits );
			}

			if(isset($values['ajaxCall']) && $values['ajaxCall'] == true) {
				return response()->json([
					'status' 	=> true,
					'html'		=> (string)view('listes-courses.productslist', [
						'liste' => $this->currentListe
					])
				]);
			}
		}
		return redirect(url('liste-courses'))->with('success', 'Produit ajouté à la liste');
	}

	public function createAndAddProduct(Request $request) {
		if($request->method() == 'POST') {
            //if validation fails, validate returns an exception and route on the view
            $this->validate($request, [
                'nom'			=> 'required',
                'quantite'		=> 'required',
                'quantite_min'	=> 'required',
            ]);

            $values = $request->all();

			// check et récup du produit s'il existe déjà
			$produit = Produit::where('nom', 'LIKE', $values['nom'])->first();
			if(is_null($produit)) {
				$produit = new Produit;

				// $operation = new Operation;
				// $operation->operation	= '+';
				// $operation->quantite	= $values['quantite'];
				// $operation->detail		= 'Première entrée';
				//
				// $produit->operations()->add($operation);
			}

			$produit->categorie_id	= ($values['categorie_id'] > 0 ? $values['categorie_id'] : null);
			$produit->nom			= $values['nom'];
			$produit->description	= $values['description'];
			$produit->quantite_min	= (strlen($values['quantite_min']) > 0 ? $values['quantite_min'] : 0);
            $produit->push();

			// et dans tous les cas :
			$ligneProduit = new Ligneproduit([ 'produit_id' => $produit->id, 'quantite' => 1 ]);
			$this->currentListe->lignesproduits()->save( $ligneProduit );

			return redirect(url('liste-courses'))->with('success', 'Données mises à jour');
        }

        return view('listes-courses.product_add', [
            'title'			=> 'Ajout d\'un produit à la liste',
            'categories'	=> Categorie::getList()
        ]);
	}

	public function deleteproduits($id) {
		$ligneProduit = $this->currentListe->lignesproduits()->whereId($id)->first();
		if(is_null($ligneProduit) || !$ligneProduit->delete()) {
			return redirect(url('produits'))->with('error', 'Impossible de retirer le produit de la liste de courses');
		}
		return redirect(url('liste-courses'))->with('success', 'Produit supprimé de la liste de courses');
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
		return redirect(url('/'))->with('success', 'Liste close, les stocks de produits on étés mis à jour');
	}

	public function changequantity($type, $id) {
		$ligneProduit = $this->currentListe->lignesproduits()->whereId($id)->first();

		if($type === 'del' && $ligneProduit->quantite === 1) {
			$ligneProduit->delete();
		} elseif ($type === 'del') {
			$ligneProduit->quantite--;
			$ligneProduit->save();
		} elseif ($type === 'add') {
			$ligneProduit->quantite++;
			$ligneProduit->save();
		}
		return redirect(url('liste-courses'))->with('success', 'Données mises à jour');
	}

	public function export($type) {
		$datas = [
			'title' => 'Liste de courses du '.\Carbon\Carbon::now()->format('d/m/Y à H:i'),
			'liste' => $this->currentListe
		];

		if($type === 'pdf') {
			$pdf = \PDF::loadView('pdf.exportliste', $datas);
			return $pdf->download('liste-courses.pdf');
		} elseif($type === 'trello') {
			$response = $this->currentListe->exportToTrello();
			if($response['status'] == true) {
				return redirect(url('liste-courses'))->with('success', $response['message']);
			} else {
				return redirect(url('liste-courses'))->with('error', $response['message']);
			}
		}
	}

	public function generate()
	{
		if(!empty($this->currentListe->lignesproduits)){
			$this->currentListe->lignesproduits()->delete();
		}

		Agendaproducts::all()->map(function($produit) {
			if($produit->manquant <= 0) {
				continue;
			}

			$ligneProduit = new Ligneproduit([ 'produit_id' => $produit->produit_id, 'quantite' => $produit->manquant ]);
			$this->currentListe->lignesproduits()->save( $ligneProduit );
		});

		return redirect(url('liste-courses'))->with('success', 'La liste de course a été mise à jour');
	}
}
