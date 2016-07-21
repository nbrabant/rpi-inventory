<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

// use App\Categorie;
// use App\Produit;
// use App\Operation;
// use App\Liste;
// use App\Ligneproduit;

class DatabaseSeeder extends Seeder
{
	// public static $categories = [
	// 	'Viandes',
	// 	'Poissons',
	// 	'Fruits',
	// 	'Légumes',
	// 	'Frais',
	// 	'Surgelés',
	// 	'Epicerie salée',
	// 	'Epicerie sucrée',
	// 	'Boissons',
	// 	'Hygiène/beauté',
	// 	'Entretien/nettoyage',
	// 	'Animalerie',
	// 	'Bazar - Textile',
	// ];

	// public static $produits = [
	// 	1 => ['Blanc de poulet', 'Canard', 'Viande hachée', 'Steak'],
	// 	2 => ['Saumon', 'Colin', 'Surimi'],
	// 	3 => ['Tomate', 'banane', 'pomme', 'nectarine', 'courgette', 'raisin sec'],
	// 	4 => ['Salade', 'oignons'],
	// 	5 => ['brioche', 'petit pain', 'pain burger', 'madeleine', 'pain', 'oeuf', 'beurre', 'camembert', 'brie', 'charcuterie seche', 'yaourt', 'mousse chocolat'],
	// 	6 => ['pizza', 'glace'],
	// 	7 => ['pâtes', 'riz', 'haricot vert', 'tomate pelée', 'champignon', 'cacahuete', 'chips', 'mayonnaise', 'soupe'],
	// 	8 => ['confiture', 'nutella', 'café', 'filtre à café', 'cereales', 'biscuit', 'chocolat en poudre', 'farine', 'sucre'],
	// 	9 => ['lait', 'eau', 'coca', 'jus de fruit', 'biere', 'vin', 'champagne'],
	// 	10 => ['tampon', 'serviette', 'savon corps', 'shampooing', 'brosse a dent', 'dentifrice', 'papier hygienique', 'mouchoir'],
	// 	11 => ['sopalin', 'lingette', 'lessive', 'liquide vaiselle', 'sac poubelle', 'desodorisant'],
	// 	12 => ['litiere', 'croquettes', 'pâté'],
	// 	13 => ['ampoule', 'presse', 'piles', 'allumette', 'collant', 'chaussette']
	// ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		// factory(Categorie::class, 13)->create()->each(function($c) {
		// 	$c->nom = array_shift( DatabaseSeeder::$categories );
		// 	$c->save();
		// 	foreach (self::$produits[$c->id] as $produit) {
		// 		$c->produits()->create([
		// 			'categorie_id'	=> $c->id,
		// 			'nom'			=> $produit,
		// 			'description'	=> $produit.' : '.str_random( rand(5, 125) ),
		// 			'quantite'		=> rand(0, 10),
		// 			'quantite_min'	=> rand(0, 5),
		// 			'unite' 		=> ''
		// 		]);
		// 	}
		// });

		$this->call(CategorieTableSeeder::class);
		$this->call(ProduitTableSeeder::class);
		$this->call(RecetteTableSeeder::class);
		$this->call(RecetteProduitsTableSeeder::class);

        Model::reguard();
    }
}
