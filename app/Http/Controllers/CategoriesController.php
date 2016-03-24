<?php  namespace App\Http\Controllers;

use App\Categorie;
use App\Produit;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

	/* liste catégories */
	public function index(Categorie $categorie)
	{
		return view('categories.index', [
			'title'     => 'Catégories',
			'categories'=> $categorie->byPosition()->get(),
			'js_files'		=> ['category.js']
		]);
	}

	/* produits de la catégorie */
	public function show(Categorie $categorie)
	{
		return view('categories.show', [
			'title'     => 'Catégorie : '.$categorie->nom,
			'categorie'	=> $categorie,
			'produits'	=> Produit::where('categorie_id', $categorie->id)->get()
		]);
	}

	public function add(Categorie $categorie, Request $request)
	{
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

	public function edit(Categorie $categorie, Request $request)
	{
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
            'categorie'     => $categorie
        ]);
    }

	public function sortlist(Request $request)
	{
		var_dump($request->positions);


		$i = 1;
		// Loop though the <li>
		foreach ($request->positions as $recordID) {
	var_dump($recordID); exit;

			// DB::table('downloads')->where('id', '=', $recordID)->update(array('order' => $i));
			$i++;
		}
		return response()->json('ok');
	}

	//gestion position d'image
	// public function action_positions($produit_id = null) {
	// 	if (Input::is_ajax()) {
	// 		if (is_null($produit_id) || !is_numeric($produit_id)) {
	// 			throw new HttpNotFoundException();
	// 		}
	// 		$produit = Model_Produit::query()
	// 			->where('id', $produit_id)
	// 			->get_one();
	// 		if (is_null($produit) OR !($produit instanceof Model_Produit)) {
	// 			Message::error('Une erreur est survenue lors du chargement de la ligne.');
	// 			return Response::redirect(Input::referrer(Core::autoAdminURI('', true)));
	// 		}
	// 		$positions = json_decode(Input::post('positions'));
	//
	// 		$success = true;
	// 		$images = Model_Image::query()->where('produit_id', $produit_id)->get();
	// 		if (is_null($images) || !array($images)) {
	// 			$success = false;
	// 		}
	//
	// 		if ($success == true) {
	// 			foreach ($positions as $position => $posObject) {
	// 				if (array_key_exists($posObject->id, $images)) {
	// 					$images[$posObject->id]->position = $position;
	// 					if (!$images[$posObject->id]->save()) {
	// 						$success = false;
	// 					}
	// 				}
	// 			}
	// 		}
	//
	// 		if ($success == true) {
	// 			return Response::forge(json_encode(array('status' => true)));
	// 		} else {
	// 			return Response::forge(json_encode(array('status' => false)));
	// 		}
	// 	}
	// 	throw new HttpNotFoundException();
	// }
}
