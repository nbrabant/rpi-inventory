<?php namespace App\Http\Controllers;

use App\Produit;
use App\Liste;
use App\Ligneproduit;
use App\Operation;
use Illuminate\Http\Request;
use App\Trellomanager;

class ListesController extends Controller {

	public $currentListe = null;

	public function __construct() {
		// récup first liste non terminée, si !liste -> create
		$this->currentListe = Liste::firstOrCreate(['termine' => 0]);
	}

	public function index() {


        return view('listes.index', [
            'title'			=> 'Liste de courses',
            'liste'			=> $this->currentListe,
            'produits'		=> Produit::getOutOfStockProducts($this->currentListe->getProductListIds()),
			'trello_token'	=> config('services.trello.client_token')
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
		return redirect(url('liste-courses'))->with('success', 'Produit ajouté à la liste');
	}

	public function deleteproduits($id) {
		$ligneProduit = $this->currentListe->lignesproduits()->whereId($id)->first();
		if(is_null($ligneProduit) || !($ligneProduit instanceof Ligneproduit) || !$ligneProduit->delete()) {
			// error message
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
			$response = Trellomanager::exportToTrello($this->currentListe);
			if($response['status'] == true) {
				return redirect(url('liste-courses'))->with('success', $response['message']);
			} else {
				return redirect(url('liste-courses'))->with('error', $response['message']);
			}
		} elseif($type === 'mail') {
			try {
				\Mail::send('emails.exportliste', $datas, function ($m) use ($datas) {
					$m->from('brabantnicolas59@gmail.com', 'admin')
						->to('brabantnicolas59@gmail.com', 'user')
						->subject($datas['title']);
				});
			} catch (Exception $e) {
				echo $e->getTraceAsString(); exit;
			}
			return redirect(url('liste-courses'))->with('error', 'Fonctionnel à venir');
		}
	}
}
