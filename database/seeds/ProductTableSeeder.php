<?php

use App\Domain\Stock\Entities\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder {

	public static $categoriesProducts = [
		1 => [
			'Blanc de poulet' 		=> '---',
			'Canard'  				=> '---',
			'Viande hachée'  		=> '---',
			'Steak'  				=> '---',
			'Jambon'  				=> 'grammes',
			'Bacon'  				=> 'grammes',
			'Lardons fumés'  		=> 'grammes'
		],
		2 => [
			'Saumon' 				=> '---',
			'Colin' 				=> '---',
			'Surimi' 				=> '---'
		],
		3 => [
			'Tomate' 				=> '---',
			'banane' 				=> '---',
			'pomme' 				=> '---',
			'nectarine' 			=> '---',
			'courgette' 			=> '---',
			'raisin sec' 			=> '---'
		],
		4 => [
			'Salade' 				=> '---',
			'oignons' 				=> '---',
			'poivrons' 				=> '---',
			'Haricot vert' 			=> 'grammes',
			'Haricot rouge' 		=> 'grammes',
			'Ail' 					=> 'grammes',
			'Courgette'				=> '',
			'Echalote'				=> '',
			'Poivrons rouge'		=> '',
			'Pommes de terre'		=> '',
			'Epinard'				=> '',
		],
		5 => [
			'brioche' 				=> '---',
			'petit pain' 			=> '---',
			'pain burger' 			=> '---',
			'madeleine' 			=> '---',
			'pain' 					=> '---',
			'oeuf' 					=> '---',
			'beurre' 				=> '---',
			'camembert' 			=> '---',
			'brie' 					=> '---',
			'charcuterie seche' 	=> '---',
			'yaourt' 				=> '---',
			'mousse chocolat' 		=> '---',
			'Maroiles' 				=> 'grammes',
			'Crème fraiche' 		=> '---',
			'gruyère' 				=> 'grammes',
			'Béchamel' 				=> 'grammes',
			'Pâte feuilletée' 		=> 'grammes',
			'Chèvre' 				=> 'grammes',
			'Munster' 				=> 'grammes',
			'Pâte brisée'			=> '',
			'Crevettes'				=> '',
			'Comté'					=> '',
			'Parmesan'				=> '',
		],
		6 => [
			'pizza' 				=> '---',
			'glace' 				=> '---'
		],
		7 => [
			'pâtes' 				=> '---',
			'riz' 					=> '---',
			'haricot vert' 			=> '---',
			'tomate pelée' 			=> '---',
			'champignon' 			=> '---',
			'cacahuete' 			=> '---',
			'chips' 				=> '---',
			'mayonnaise' 			=> '---',
			'soupe' 				=> '---',
			'Thon' 					=> 'grammes',
			'Chili poudre' 			=> 'grammes',
			'Sel' 					=> 'grammes',
			'Poivre' 				=> 'grammes',
			'Huile d\'olive' 		=> 'litre',
			'Gnocchis' 				=> 'grammes',
			'Concentré de tomate' 	=> 'grammes',
			'Curry'					=> 'grammes',
			'Ciboulette'			=> '',
			'Moutarde'				=> '',
			'Aneth'					=> '',
			'MaÏs'					=> '',
			'Chapelure'				=> '',
			'Thym'					=> '',
			'Maizena'				=> '',
		],
		8 => [
			'confiture' 			=> '---',
			'nutella' 				=> '---',
			'café' 					=> '---',
			'filtre à café' 		=> '---',
			'cereales' 				=> '---',
			'biscuit' 				=> '---',
			'chocolat en poudre' 	=> '---',
			'farine' 				=> 'grammes',
			'sucre'					=> '---'
		],
		9 => [
			'lait' 					=> 'litre',
			'eau' 					=> 'litre',
			'coca' 					=> 'litre',
			'jus de fruit' 			=> 'litre',
			'biere' 				=> '---',
			'vin' 					=> '---',
			'champagne'				=> '---'
		],
		10 => [
			'tampon' 				=> '---',
			'serviette' 			=> '---',
			'savon corps' 			=> '---',
			'shampooing' 			=> '---',
			'brosse a dent' 		=> '---',
			'dentifrice' 			=> '---',
			'papier hygienique' 	=> '---',
			'mouchoir'				=> '---'
		],
		11 => [
			'sopalin' 				=> '---',
			'lingette' 				=> '---',
			'lessive' 				=> '---',
			'liquide vaiselle' 		=> '---',
			'sac poubelle' 			=> '---',
			'desodorisant'			=> '---'
		],
		12 => [
			'litiere' 				=> '---',
			'croquettes' 			=> '---',
			'pâté'					=> '---'
		],
		13 => [
			'ampoule' 				=> '---',
			'presse' 				=> '---',
			'piles' 				=> '---',
			'allumette' 			=> '---',
			'collant' 				=> '---',
			'chaussette'			=> '---'
		],
	];

	private $_datasToSeed = [];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		$this->formatDataToSeed();

		foreach ($this->_datasToSeed as $data) {
			Product::create($data);
		}
	}

	private function formatDataToSeed() {
		foreach (self::$categoriesProducts as $categoryId => $products) {
			foreach ($products as $name => $unite) {
				$this->_datasToSeed[] = [
					'category_id' 	=> $categoryId,
					'name' 			=> $name,
					'quantity' 		=> '0',
					'unit'	 		=> null, //($unite !== '---' ? $unite : null),
				];
			}
		}
	}
}
