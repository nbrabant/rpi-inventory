<?php

use App\Models\Operation;
use Illuminate\Database\Seeder;

class OperationTableSeeder extends Seeder {

	private $_datasToSeed = [
		// [
		// 	'produit_id' => 1,
		// 	'quantite' => 5,
		// 	'operation' => '+',
		// 	'detail' => ''
		// ],
		// [
		// 	'produit_id' => 1,
		// 	'quantite' => 5,
		// 	'operation' => '+',
		// 	'operation' => 'second ajout'
		// 	],
		// [
		// 	'produit_id' => 2,
		// 	'quantite' => 1,
		// 	'operation' => '+',
		// 	'operation' => 'Première entrée'
		// ],
		// [
		// 	'produit_id' => 3,
		// 	'quantite' => 1,
		// 	'operation' => '+',
		// 	'operation' => 'Première entrée'
		// ],
		// [
		// 	'produit_id' => 4,
		// 	'quantite' => 2,
		// 	'operation' => '+',
		// 	'operation' => 'Première entrée'
		// ],
		// [
		// 	'produit_id' => 1,
		// 	'quantite' => 2,
		// 	'operation' => '-',
		// 	'operation' => 'test retrait'
		// ],
		// [
		// 	'produit_id' => 4,
		// 	'quantite' => 1,
		// 	'operation' => '-',
		// 	'operation' => 'vide'
		// ],
		// [
		// 	'produit_id' => 4,
		// 	'quantite' => 2,
		// 	'operation' => '+',
		// 	'operation' => 'courses'
		// ],
		// [
		// 	'produit_id' => 4,
		// 	'quantite' => 1,
		// 	'operation' => '-',
		// 	'operation' => 'donné au voisin'
		// ],
		// [
		// 	'produit_id' => 4,
		// 	'quantite' => 2,
		// 	'operation' => '-',
		// 	'operation' => 'perdus'
		// ],
	];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		foreach ($this->_datasToSeed as $data) {
			Operation::create($data);
		}
	}
}
