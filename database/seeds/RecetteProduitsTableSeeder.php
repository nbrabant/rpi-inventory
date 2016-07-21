<?php

use App\Produit;
use App\RecetteProduit;
use Illuminate\Database\Seeder;

// (2, 1, 1, 2, NULL),
// (1, 1, 15, 1, NULL),
// (4, 1, 72, 50, 'grammes'),

// (31, 2, 21, 25, 'centilitre'),
// (33, 2, 22, 4, NULL),
// (32, 2, 23, 30, 'grammes'),
// (35, 2, 47, 125, 'grammes'),
// (34, 2, 48, 50, 'grammes'),

// (38, 3, 3, 450, 'grammes'),
// (39, 3, 15, 1, NULL),
// (37, 3, 31, 300, 'grammes'),

// (40, 4, 9, 4, NULL),
// (41, 4, 75, 4, NULL),

// (42, 5, 32, 1, 'grand_verre'),
// (43, 5, 77, 50, 'centilitre'),
// (44, 5, 78, 1, NULL),

// (47, 6, 3, 400, 'grammes'),
// (45, 6, 15, 1, NULL),
// (49, 6, 34, 1, NULL),
// (48, 6, 80, 400, 'grammes'),
// (50, 6, 81, 2, 'cuillere_cafe'),
// (46, 6, 82, 1, NULL),

// (55, 7, 22, 2, NULL),
// (52, 7, 75, 3, NULL),
// (53, 7, 35, 1, NULL),
// (51, 7, 86, 1, NULL),
// (54, 7, 87, 1, NULL),

// (59, 8, 22, 1, NULL),
// (60, 8, 73, 3, 'cuillere_soupe'),
// (56, 8, 88, 600, 'grammes'),
// (57, 8, 89, 200, 'grammes'),
// (58, 8, 90, 150, 'grammes'),

// (63, 9, 15, 1, NULL),
// (61, 9, 31, 400, 'grammes'),
// (65, 9, 73, 1, 'verre_moutarde'),
// (66, 9, 76, 1, NULL),
// (62, 9, 78, 1, 'grammes'),
// (64, 9, 91, 1, NULL),

// (67, 10, 1, 300, 'grammes'),
// (68, 10, 15, 2, NULL),
// (70, 10, 85, 1, 'cuillere_soupe'),
// (69, 10, 92, 2, 'cuillere_cafe'),

// (74, 11, 22, 4, NULL);
// (73, 11, 35, 1, NULL),
// (72, 11, 73, 2, 'cuillere_soupe'),
// (71, 11, 93, 200, 'grammes'),


class RecetteProduitsTableSeeder extends Seeder
{

	private $_datasToSeed = [
		[ 'recette_id' => 1, 'produit' => 'Blanc de poulet', 'quantite' => '2' ],
		[ 'recette_id' => 1, 'produit' => 'oignons', 'quantite' => '1' ],
		[ 'recette_id' => 1, 'produit' => 'Maroilles', 'quantite' => '50', 'unite' => 'grammes' ],

		[ 'recette_id' => 2, 'produit' => 'lait', 'quantite' => '25', 'unite' => 'centilitre' ],
		[ 'recette_id' => 2, 'produit' => 'beurre', 'quantite' => '30', 'unite' => 'grammes' ],
		[ 'recette_id' => 2, 'produit' => 'oeuf', 'quantite' => '4' ],
		[ 'recette_id' => 2, 'produit' => 'farine', 'quantite' => '125', 'unite' => 'grammes' ],
		[ 'recette_id' => 2, 'produit' => 'sucre', 'quantite' => '50', 'unite' => 'grammes' ],

		[ 'recette_id' => 3, 'produit' => 'Viande hachée', 'quantite' => '450', 'unite' => 'grammes' ],
		[ 'recette_id' => 3, 'produit' => 'oignons', 'quantite' => '1' ],
		[ 'recette_id' => 3, 'produit' => 'pâtes', 'quantite' => '300', 'unite' => 'grammes' ],

		[ 'recette_id' => 4, 'produit' => 'banane', 'quantite' => '4' ],
		[ 'recette_id' => 4, 'produit' => 'jambon', 'quantite' => '4' ],

		[ 'recette_id' => 5, 'produit' => 'riz', 'quantite' => '1', 'unite' => 'grand_verre' ],
		[ 'recette_id' => 5, 'produit' => 'Béchamel', 'quantite' => '50', 'unite' => 'centilitre' ],
		[ 'recette_id' => 5, 'produit' => 'Thon', 'quantite' => '1' ],

		[ 'recette_id' => 6, 'produit' => 'Viande hachée', 'quantite' => '400', 'unite' => 'grammes' ],
		[ 'recette_id' => 6, 'produit' => 'oignons', 'quantite' => '1' ],
		[ 'recette_id' => 6, 'produit' => 'tomate pelée', 'quantite' => '1' ],
		[ 'recette_id' => 6, 'produit' => 'Haricot rouge', 'quantite' => '400', 'unite' => 'grammes' ],
		[ 'recette_id' => 6, 'produit' => 'Chili poudre', 'quantite' => '2', 'unite' => 'cuillere_cafe' ],
		[ 'recette_id' => 6, 'produit' => 'Ail', 'quantite' => '1' ],

		[ 'recette_id' => 7, 'produit' => 'oeuf', 'quantite' => '2' ],
		[ 'recette_id' => 7, 'produit' => 'jambon', 'quantite' => '3' ],
		[ 'recette_id' => 7, 'produit' => 'champignon', 'quantite' => '1' ],
		[ 'recette_id' => 7, 'produit' => 'Pâte feuilletée', 'quantite' => '1' ],
		[ 'recette_id' => 7, 'produit' => 'Chévre', 'quantite' => '1' ],

		[ 'recette_id' => 8, 'produit' => 'oeuf', 'quantite' => '1' ],
		[ 'recette_id' => 8, 'produit' => 'Créme fraiche', 'quantite' => '1', 'unite' => 'cuillere_soupe' ],
		[ 'recette_id' => 8, 'produit' => 'Gnocchis', 'quantite' => '600', 'unite' => 'grammes' ],
		[ 'recette_id' => 8, 'produit' => 'Munster', 'quantite' => '200', 'unite' => 'grammes' ],
		[ 'recette_id' => 8, 'produit' => 'Bacon', 'quantite' => '150', 'unite' => 'grammes' ],

		[ 'recette_id' => 9, 'produit' => 'oignons', 'quantite' => '1' ],
		[ 'recette_id' => 9, 'produit' => 'pâtes', 'quantite' => '400', 'unite' => 'grammes' ],
		[ 'recette_id' => 9, 'produit' => 'Créme fraiche', 'quantite' => '1', 'unite' => 'verre_moutarde' ],
		[ 'recette_id' => 9, 'produit' => 'gruyere', 'quantite' => '1' ],
		[ 'recette_id' => 9, 'produit' => 'Thon', 'quantite' => '1', 'unite' => 'grammes' ],
		[ 'recette_id' => 9, 'produit' => 'Concentré de tomate', 'quantite' => '1' ],

		[ 'recette_id' => 10, 'produit' => 'Blanc de poulet', 'quantite' => '300', 'unite' => 'grammes' ],
		[ 'recette_id' => 10, 'produit' => 'oignons', 'quantite' => '2' ],
		[ 'recette_id' => 10, 'produit' => 'Huile d\'olive', 'quantite' => '1', 'unite' => 'cuillere_soupe' ],
		[ 'recette_id' => 10, 'produit' => 'Curry', 'quantite' => '2', 'unite' => 'cuillere_cafe' ],

		[ 'recette_id' => 11, 'produit' => 'oeuf', 'quantite' => '4' ],
		[ 'recette_id' => 11, 'produit' => 'champignon', 'quantite' => '1' ],
		[ 'recette_id' => 11, 'produit' => 'Créme fraiche', 'quantite' => '1', 'unite' => 'cuillere_soupe' ],
		[ 'recette_id' => 11, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->_datasToSeed as $datas) {
			$produit = Produit::where('nom', 'LIKE', $datas['produit'])->get();
			if(is_null($produit)) {
				continue;
			}

			$recetteProduit = [
				'recette_id' 	=> $datas['recette_id'],
				'produit_id' 	=> $produit->id,
				'quantite' 		=> $datas['quantite'],
			];

			if(isset($datas['unite'])) {
				$recetteProduit['unite'] = $datas['quantite'];
			}

			RecetteProduit::create($recetteProduit);
		}
    }
}
