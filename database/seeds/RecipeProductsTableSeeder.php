	<?php

use App\Domain\Stock\Entities\Product;
use App\Domain\Recipe\Entities\RecipeProduct;
use Illuminate\Database\Seeder;

class RecipeProductsTableSeeder extends Seeder
{

	private $_datasToSeed = [
		[ 'recipe_id' => 1, 'product' => 'Blanc de poulet', 'quantity' => '2' ],
		[ 'recipe_id' => 1, 'product' => 'oignons', 'quantity' => '1' ],
		[ 'recipe_id' => 1, 'product' => 'Maroilles', 'quantity' => '50', 'unit' => 'grammes' ],

		[ 'recipe_id' => 2, 'product' => 'lait', 'quantity' => '25', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 2, 'product' => 'beurre', 'quantity' => '30', 'unit' => 'grammes' ],
		[ 'recipe_id' => 2, 'product' => 'oeuf', 'quantity' => '4' ],
		[ 'recipe_id' => 2, 'product' => 'farine', 'quantity' => '125', 'unit' => 'grammes' ],
		[ 'recipe_id' => 2, 'product' => 'sucre', 'quantity' => '50', 'unit' => 'grammes' ],

		[ 'recipe_id' => 3, 'product' => 'Viande hachée', 'quantity' => '450', 'unit' => 'grammes' ],
		[ 'recipe_id' => 3, 'product' => 'oignons', 'quantity' => '1' ],
		[ 'recipe_id' => 3, 'product' => 'pâtes', 'quantity' => '300', 'unit' => 'grammes' ],

		[ 'recipe_id' => 4, 'product' => 'banane', 'quantity' => '4' ],
		[ 'recipe_id' => 4, 'product' => 'jambon', 'quantity' => '4' ],

		[ 'recipe_id' => 5, 'product' => 'riz', 'quantity' => '1', 'unit' => 'grand_verre' ],
		[ 'recipe_id' => 5, 'product' => 'Béchamel', 'quantity' => '50', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 5, 'product' => 'Thon', 'quantity' => '1' ],

		[ 'recipe_id' => 6, 'product' => 'Viande hachée', 'quantity' => '400', 'unit' => 'grammes' ],
		[ 'recipe_id' => 6, 'product' => 'oignons', 'quantity' => '1' ],
		[ 'recipe_id' => 6, 'product' => 'tomate pelée', 'quantity' => '1' ],
		[ 'recipe_id' => 6, 'product' => 'Haricot rouge', 'quantity' => '400', 'unit' => 'grammes' ],
		[ 'recipe_id' => 6, 'product' => 'Chili poudre', 'quantity' => '2', 'unit' => 'cuilliere_cafe' ],
		[ 'recipe_id' => 6, 'product' => 'Ail', 'quantity' => '1' ],

		[ 'recipe_id' => 7, 'product' => 'oeuf', 'quantity' => '2' ],
		[ 'recipe_id' => 7, 'product' => 'jambon', 'quantity' => '3' ],
		[ 'recipe_id' => 7, 'product' => 'champignon', 'quantity' => '1' ],
		[ 'recipe_id' => 7, 'product' => 'Pâte feuilletée', 'quantity' => '1' ],
		[ 'recipe_id' => 7, 'product' => 'Chévre', 'quantity' => '1' ],

		[ 'recipe_id' => 8, 'product' => 'oeuf', 'quantity' => '1' ],
		[ 'recipe_id' => 8, 'product' => 'Créme fraiche', 'quantity' => '1', 'unit' => 'cuilliere_soupe' ],
		[ 'recipe_id' => 8, 'product' => 'Gnocchis', 'quantity' => '600', 'unit' => 'grammes' ],
		[ 'recipe_id' => 8, 'product' => 'Munster', 'quantity' => '200', 'unit' => 'grammes' ],
		[ 'recipe_id' => 8, 'product' => 'Bacon', 'quantity' => '150', 'unit' => 'grammes' ],

		[ 'recipe_id' => 9, 'product' => 'oignons', 'quantity' => '1' ],
		[ 'recipe_id' => 9, 'product' => 'pâtes', 'quantity' => '400', 'unit' => 'grammes' ],
		[ 'recipe_id' => 9, 'product' => 'Créme fraiche', 'quantity' => '1', 'unit' => 'verre_moutarde' ],
		[ 'recipe_id' => 9, 'product' => 'gruyere', 'quantity' => '1' ],
		[ 'recipe_id' => 9, 'product' => 'Thon', 'quantity' => '1', 'unit' => 'grammes' ],
		[ 'recipe_id' => 9, 'product' => 'Concentré de tomate', 'quantity' => '1' ],

		[ 'recipe_id' => 10, 'product' => 'Blanc de poulet', 'quantity' => '300', 'unit' => 'grammes' ],
		[ 'recipe_id' => 10, 'product' => 'oignons', 'quantity' => '2' ],
		[ 'recipe_id' => 10, 'product' => 'Huile d\'olive', 'quantity' => '1', 'unit' => 'cuilliere_soupe' ],
		[ 'recipe_id' => 10, 'product' => 'Curry', 'quantity' => '2', 'unit' => 'cuilliere_cafe' ],

		[ 'recipe_id' => 11, 'product' => 'oeuf', 'quantity' => '4' ],
		[ 'recipe_id' => 11, 'product' => 'champignon', 'quantity' => '1' ],
		[ 'recipe_id' => 11, 'product' => 'Créme fraiche', 'quantity' => '1', 'unit' => 'cuilliere_soupe' ],
		[ 'recipe_id' => 11, 'product' => 'Lardons fumés', 'quantity' => '200', 'unit' => 'grammes' ],

		[ 'recipe_id' => 12, 'product' => 'Pâte brisée', 'quantity' => '1' ],
		[ 'recipe_id' => 12, 'product' => 'Saumon', 'quantity' => '1' ],
		[ 'recipe_id' => 12, 'product' => 'Crème fraiche', 'quantity' => '20', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 12, 'product' => 'oeuf', 'quantity' => '3' ],
		[ 'recipe_id' => 12, 'product' => 'Ciboulette', 'quantity' => '1' ],

		[ 'recipe_id' => 13, 'product' => 'Courgette', 'quantity' => '4' ],
		[ 'recipe_id' => 13, 'product' => 'Crème fraiche', 'quantity' => '15', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 13, 'product' => 'oeuf', 'quantity' => '1' ],
		[ 'recipe_id' => 13, 'product' => 'gruyère', 'quantity' => '100', 'unit' => 'grammes' ],

		[ 'recipe_id' => 14, 'product' => 'Blanc de poulet', 'quantity' => '4' ],
		[ 'recipe_id' => 14, 'product' => 'Moutarde', 'quantity' => '2' ],
		[ 'recipe_id' => 14, 'product' => 'Crème fraiche', 'quantity' => '6' ],

		[ 'recipe_id' => 15, 'product' => 'pâtes', 'quantity' => '200', 'unit' => 'grammes' ],
		[ 'recipe_id' => 15, 'product' => 'Saumon', 'quantity' => '2' ],
		[ 'recipe_id' => 15, 'product' => 'Crème fraiche', 'quantity' => '10', 'unit' => 'centilitre' ],

		[ 'recipe_id' => 16, 'product' => 'Pâte brisée', 'quantity' => '1' ],
		[ 'recipe_id' => 16, 'product' => 'oeuf', 'quantity' => '3' ],
		[ 'recipe_id' => 16, 'product' => 'Crème fraiche', 'quantity' => '250', 'unit' => 'grammes' ],
		[ 'recipe_id' => 16, 'product' => 'Lardons fumés', 'quantity' => '150', 'unit' => 'grammes' ],

		[ 'recipe_id' => 17, 'product' => 'riz', 'quantity' => '200', 'unit' => 'grammes' ],
		[ 'recipe_id' => 17, 'product' => 'MaÏs', 'quantity' => '1' ],
		[ 'recipe_id' => 17, 'product' => 'Thon', 'quantity' => '1' ],
		[ 'recipe_id' => 17, 'product' => 'Tomate', 'quantity' => '3' ],
		[ 'recipe_id' => 17, 'product' => 'oeuf', 'quantity' => '2' ],
		[ 'recipe_id' => 17, 'product' => 'Huile d\'olive', 'quantity' => '2' ],

		[ 'recipe_id' => 18, 'product' => 'Tomate', 'quantity' => '4' ],
		[ 'recipe_id' => 18, 'product' => 'Viande hachée', 'quantity' => '220', 'unit' => 'grammes' ],
		[ 'recipe_id' => 18, 'product' => 'oignons', 'quantity' => '2' ],
		[ 'recipe_id' => 18, 'product' => 'Echalote', 'quantity' => '1' ],
		[ 'recipe_id' => 18, 'product' => 'Ail', 'quantity' => '1' ],
		[ 'recipe_id' => 18, 'product' => 'Chapelure', 'quantity' => '2' ],
		[ 'recipe_id' => 18, 'product' => 'Huile d\'olive', 'quantity' => '2' ],

		[ 'recipe_id' => 19, 'product' => 'Crevettes', 'quantity' => '200', 'unit' => 'grammes' ],
		[ 'recipe_id' => 19, 'product' => 'Poivrons vert', 'quantity' => '1' ],
		[ 'recipe_id' => 19, 'product' => 'Poivrons rouge', 'quantity' => '1' ],
		[ 'recipe_id' => 19, 'product' => 'riz', 'quantity' => '125', 'unit' => 'grammes' ],
		[ 'recipe_id' => 19, 'product' => 'Curry', 'quantity' => '1' ],

		[ 'recipe_id' => 20, 'product' => 'Pommes de terre', 'quantity' => '1000', 'unit' => 'grammes' ],
		[ 'recipe_id' => 20, 'product' => 'Ail', 'quantity' => '7' ],

		[ 'recipe_id' => 21, 'product' => 'Comté', 'quantity' => '60', 'unit' => 'grammes' ],
		[ 'recipe_id' => 21, 'product' => 'lait', 'quantity' => '30', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 21, 'product' => 'oeuf', 'quantity' => '3' ],
		[ 'recipe_id' => 21, 'product' => 'Maizena', 'quantity' => '20', 'unit' => 'grammes' ],

		[ 'recipe_id' => 22, 'product' => 'Pâte feuilletée', 'quantity' => '1' ],
		[ 'recipe_id' => 22, 'product' => 'Epinard', 'quantity' => '250', 'unit' => 'grammes' ],
		[ 'recipe_id' => 22, 'product' => 'oignons', 'quantity' => '1' ],
		[ 'recipe_id' => 22, 'product' => 'Crème fraiche', 'quantity' => '20', 'unit' => 'centilitre' ],
		[ 'recipe_id' => 22, 'product' => 'oeuf', 'quantity' => '2' ],
		[ 'recipe_id' => 22, 'product' => 'Parmesan', 'quantity' => '60', 'unit' => 'grammes' ],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->_datasToSeed as $datas) {
			$product = Product::where('name', 'LIKE', $datas['product'])->first();
			if(is_null($product)) {
				continue;
			}

			$recetteProduit = [
				'recipe_id' 	=> $datas['recipe_id'],
				'product_id' 	=> $product->id,
				'quantity' 		=> $datas['quantity'],
			];

			if(isset($datas['unit'])) {
				$recetteProduit['unit'] = $datas['unit'];
			}

			RecipeProduct::create($recetteProduit);
		}
    }
}
