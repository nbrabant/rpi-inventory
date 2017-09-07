<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {

	private $_datasToSeed = [
		'Viandes',
		'Poissons',
		'Fruits',
		'Légumes',
		'Frais',
		'Surgelés',
		'Epicerie salée',
		'Epicerie sucrée',
		'Boissons',
		'Hygiène/beauté',
		'Entretien/nettoyage',
		'Animalerie',
		'Bazar - Textile',
	];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		foreach ($this->_datasToSeed as $data) {
			Category::create([
				'nom'   => $data,
			]);
		}
	}
}
