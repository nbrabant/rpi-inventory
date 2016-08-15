<?php

use App\Produit;
use App\RecetteProduit;
use Illuminate\Database\Seeder;

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

		[ 'recette_id' => 12, 'produit' => 'Pâte brisée', 'quantite' => '1' ],
		[ 'recette_id' => 12, 'produit' => 'Saumon', 'quantite' => '1' ],
		[ 'recette_id' => 12, 'produit' => 'Crème fraiche', 'quantite' => '20', 'unite' => 'centilitre' ],
		[ 'recette_id' => 12, 'produit' => 'oeuf', 'quantite' => '3' ],
		[ 'recette_id' => 12, 'produit' => 'Ciboulette', 'quantite' => '1' ],

		[ 'recette_id' => 13, 'produit' => 'Courgette', 'quantite' => '4' ],
		[ 'recette_id' => 13, 'produit' => 'Crème fraiche', 'quantite' => '15', 'unite' => 'centilitre' ],
		[ 'recette_id' => 13, 'produit' => 'oeuf', 'quantite' => '1' ],
		[ 'recette_id' => 13, 'produit' => 'gruyère', 'quantite' => '100', 'unite' => 'grammes' ],

		[ 'recette_id' => 14, 'produit' => 'Blanc de poulet', 'quantite' => '4' ],
		[ 'recette_id' => 14, 'produit' => 'Moutarde', 'quantite' => '2' ],
		[ 'recette_id' => 14, 'produit' => 'Crème fraiche', 'quantite' => '6' ],

		// (58, 15, 44, 200, 'grammes'),
		// (59, 15, 8, 2, NULL),
		// (60, 15, 36, 10, 'centilitre'),
		[ 'recette_id' => 15, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (61, 16, 100, 1, NULL),
		// (62, 16, 28, 3, NULL),
		// (63, 16, 36, 250, 'grammes'),
		// (64, 16, 7, 150, 'grammes'),
		[ 'recette_id' => 16, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (65, 17, 45, 200, 'grammes'),
		// (66, 17, 105, 1, NULL),
		// (67, 17, 53, 1, NULL),
		// (68, 17, 11, 3, NULL),
		// (69, 17, 28, 2, NULL),
		// (70, 17, 57, 2, ''),
		[ 'recette_id' => 17, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (71, 18, 11, 4, NULL),
		// (72, 18, 3, 220, 'grammes'),
		// (73, 18, 18, 2, NULL),
		// (74, 18, 106, 1, NULL),
		// (75, 18, 22, 1, NULL),
		// (76, 18, 107, 2, ''),
		// (77, 18, 57, 2, ''),
		[ 'recette_id' => 18, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (78, 19, 109, 200, 'grammes'),
		// (79, 19, 19, 1, NULL),
		// (80, 19, 108, 1, NULL),
		// (81, 19, 45, 125, 'grammes'),
		// (82, 19, 60, 1, ''),
		[ 'recette_id' => 19, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (83, 20, 110, 1000, 'grammes'),
		// (84, 20, 22, 7, NULL),
		[ 'recette_id' => 20, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (85, 21, 112, 60, 'grammes'),
		// (86, 21, 70, 30, 'centilitre'),
		// (87, 21, 28, 3, NULL),
		// (88, 21, 113, 20, 'grammes'),
		[ 'recette_id' => 21, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],

		// (89, 22, 39, 1, NULL),
		// (90, 22, 114, 250, 'grammes'),
		// (91, 22, 18, 1, NULL),
		// (92, 22, 36, 20, 'centilitre'),
		// (93, 22, 28, 2, NULL),
		// (94, 22, 115, 60, 'grammes');
		[ 'recette_id' => 22, 'produit' => 'Lardons fumés', 'quantite' => '200', 'unite' => 'grammes' ],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->_datasToSeed as $datas) {
			$produit = Produit::where('nom', 'LIKE', $datas['produit'])->first();
			if(is_null($produit)) {
				continue;
			}

			$recetteProduit = [
				'recette_id' 	=> $datas['recette_id'],
				'produit_id' 	=> $produit->id,
				'quantite' 		=> $datas['quantite'],
			];

			if(isset($datas['unite'])) {
				$recetteProduit['unite'] = $datas['unite'];
			}

			RecetteProduit::create($recetteProduit);
		}
    }
}
