<?php

use App\Domain\Recipe\Entities\Recipe;
use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder
{

	private $_datasToSeed = [
		[
			'name' 				=> 'Filets de poulet au maroilles',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '2 personnes',
			'preparation_time' 	=> 0,
			'cooking_time' 		=> 25,
			'complement' 		=> '2 gousses d"ail \n\n Herbes de Provence \n\n 1 oignon \n\n 50g de maroilles \n\n 4 petites pommes de terre \n\n 2 filets de poulet'
		],
		[
			'name' 				=> 'Clafoutis aux cerises',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '6 personnes',
			'preparation_time' 	=> 0,
			'cooking_time' 		=> 0,
			'complement' 		=> '25 cl de lait \n\n 1/4 c à c de cannelle \n\n 1 pincée de sel \n\n Du sucre glace \n\n 30g de beurre \n\n 500g de cerises type Montmorency \n\n 1 c à c d\'huile neutre \n\n 4 œufs entiers \n\n 50g de sucre en poudre \n\n 125g de farine'
		],
		[
			'name' 				=> 'Pâte bolognaise',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 30,
			'cooking_time' 		=> 60,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Bananes au jambon',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 20,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Riz à la béchamel et au thon',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 5,
			'cooking_time' 		=> 10,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Chili con carne express',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '3',
			'preparation_time' 	=> 5,
			'cooking_time' 		=> 30,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Feuilleté au jambon',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 15,
			'cooking_time' 		=> 20,
			'complement' 		=> NULL
		],
		[
			'name' 				=>  'Gnocchis sauce bacon',
			'recipe_type' 		=>  'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=>  20,
			'cooking_time'	 	=>  15,
			'complement' 		=>  NULL
		],
		[
			'name' 				=> 'Pâtes au thon',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '2',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 10,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Poulet au curry',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '2',
			'preparation_time' 	=> 5,
			'cooking_time' 		=> 25,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Tagliatelles à la carbonara',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 10,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Quiche au saumon',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 20,
			'cooking_time' 		=> 50,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Courgettes geainées',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 20,
			'cooking_time' 		=> 35,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Escalope de poulet à la moutarde',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 15,
			'cooking_time' 		=> 15,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Pâtes au saumon fumé',
			'recipe_type' 		=>  'entrée',
			'number_people' 	=>  '2',
			'preparation_time' 	=>  10,
			'cooking_time'	 	=>  12,
			'complement' 		=>  NULL
		],
		[
			'name' 				=> 'Quiche lorraine',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 30,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Salade de riz',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 10,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Tomates farcies',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '2',
			'preparation_time' 	=> 15,
			'cooking_time' 		=> 45,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Riz au curry et crevettes',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '2',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 20,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Pommes de terre sautées',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 30,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Soufflé au fromage',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 10,
			'cooking_time' 		=> 30,
			'complement' 		=> NULL
		],
		[
			'name' 				=> 'Quiche aux épinards',
			'recipe_type' 		=> 'entrée',
			'number_people' 	=> '4',
			'preparation_time' 	=> 15,
			'cooking_time' 		=> 40,
			'complement' 		=> NULL
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach ($this->_datasToSeed as $datas) {
			Recipe::create($datas);
		}
    }
}
