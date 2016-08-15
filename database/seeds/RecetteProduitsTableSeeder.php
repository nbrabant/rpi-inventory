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

		[ 'recette_id' => 15, 'produit' => 'pâtes', 'quantite' => '200', 'unite' => 'grammes' ],
		[ 'recette_id' => 15, 'produit' => 'Saumon', 'quantite' => '2' ],
		[ 'recette_id' => 15, 'produit' => 'Crème fraiche', 'quantite' => '10', 'unite' => 'centilitre' ],

		[ 'recette_id' => 16, 'produit' => 'Pâte brisée', 'quantite' => '1' ],
		[ 'recette_id' => 16, 'produit' => 'oeuf', 'quantite' => '3' ],
		[ 'recette_id' => 16, 'produit' => 'Crème fraiche', 'quantite' => '250', 'unite' => 'grammes' ],
		[ 'recette_id' => 16, 'produit' => 'Lardons fumés', 'quantite' => '150', 'unite' => 'grammes' ],

		[ 'recette_id' => 17, 'produit' => 'riz', 'quantite' => '200', 'unite' => 'grammes' ],
		[ 'recette_id' => 17, 'produit' => 'MaÏs', 'quantite' => '1' ],
		[ 'recette_id' => 17, 'produit' => 'Thon', 'quantite' => '1' ],
		[ 'recette_id' => 17, 'produit' => 'Tomate', 'quantite' => '3' ],
		[ 'recette_id' => 17, 'produit' => 'oeuf', 'quantite' => '2' ],
		[ 'recette_id' => 17, 'produit' => 'Huile d\'olive', 'quantite' => '2' ],

		[ 'recette_id' => 18, 'produit' => 'Tomate', 'quantite' => '4' ],
		[ 'recette_id' => 18, 'produit' => 'Viande hachée', 'quantite' => '220', 'unite' => 'grammes' ],
		[ 'recette_id' => 18, 'produit' => 'oignons', 'quantite' => '2' ],
		[ 'recette_id' => 18, 'produit' => 'Echalote', 'quantite' => '1' ],
		[ 'recette_id' => 18, 'produit' => 'Ail', 'quantite' => '1' ],
		[ 'recette_id' => 18, 'produit' => 'Chapelure', 'quantite' => '2' ],
		[ 'recette_id' => 18, 'produit' => 'Huile d\'olive', 'quantite' => '2' ],

		[ 'recette_id' => 19, 'produit' => 'Crevettes', 'quantite' => '200', 'unite' => 'grammes' ],
		[ 'recette_id' => 19, 'produit' => 'Poivrons vert', 'quantite' => '1' ],
		[ 'recette_id' => 19, 'produit' => 'Poivrons rouge', 'quantite' => '1' ],
		[ 'recette_id' => 19, 'produit' => 'riz', 'quantite' => '125', 'unite' => 'grammes' ],
		[ 'recette_id' => 19, 'produit' => 'Curry', 'quantite' => '1' ],

		[ 'recette_id' => 20, 'produit' => 'Pommes de terre', 'quantite' => '1000', 'unite' => 'grammes' ],
		[ 'recette_id' => 20, 'produit' => 'Ail', 'quantite' => '7' ],

		[ 'recette_id' => 21, 'produit' => 'Comté', 'quantite' => '60', 'unite' => 'grammes' ],
		[ 'recette_id' => 21, 'produit' => 'lait', 'quantite' => '30', 'unite' => 'centilitre' ],
		[ 'recette_id' => 21, 'produit' => 'oeuf', 'quantite' => '3' ],
		[ 'recette_id' => 21, 'produit' => 'Maizena', 'quantite' => '20', 'unite' => 'grammes' ],

		[ 'recette_id' => 22, 'produit' => 'Pâte feuilletée', 'quantite' => '1' ],
		[ 'recette_id' => 22, 'produit' => 'Epinard', 'quantite' => '250', 'unite' => 'grammes' ],
		[ 'recette_id' => 22, 'produit' => 'oignons', 'quantite' => '1' ],
		[ 'recette_id' => 22, 'produit' => 'Crème fraiche', 'quantite' => '20', 'unite' => 'centilitre' ],
		[ 'recette_id' => 22, 'produit' => 'oeuf', 'quantite' => '2' ],
		[ 'recette_id' => 22, 'produit' => 'Parmesan', 'quantite' => '60', 'unite' => 'grammes' ],
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
