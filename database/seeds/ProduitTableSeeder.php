<?php

use App\Produit;
use Illuminate\Database\Seeder;

class ProduitTableSeeder extends Seeder {

	private $_datasToSeed = [
		[
			'categorie_id' => '2',
			'nom' => 'Pomme de terre',
			'description' => 'Pomme de terre',
			'quantite' => '10',
			'quantite_min' => '5',
		],
		[
			'categorie_id' => '4',
			'nom' => 'Kwak',
			'description' => 'bouteille de Kwak de 1,5 litre',
			'quantite' => '1',
		],
		[
			'categorie_id' => '2',
			'nom' => 'Beurre',
			'description' => 'Barquette de 250 grammes',
			'quantite' => '1',
			'quantite_min' => '1',
		],
		[
			'categorie_id' => '2',
			'nom' => 'Liquide vaisselle',
			'description' => '',
			'quantite' => '0',
			'quantite_min' => '1',
		],
	];
			
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		
		foreach ($this->_datasToSeed as $data) {
			Produit::create($data);
		}
	}
}
