<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Categorie;
use App\Produit;
use App\Operation;
use App\Liste;
use App\Ligneproduit;

class DatabaseSeeder extends Seeder
{
	public static $categories = [
		'Bazar/Textile',
		'Animalerie',
		'Entretien/nettoyage',
		'Hygiène/beauté',
		'Boissons',
		'Epicerie sucrée',
		'Epicerie salée',
		'Surgelés',
		'Frais',
		'Légumes',
		'Fruits',
		'Poissons',
		'Viandes',
	];

	public static $produits = [
		1 => ['Blanc de poulet', 'Canard', 'Viande hachée', 'Steak'],
		2 => ['Saumon', 'Colin'],
		3 => ['Tomate', 'banane', 'pomme', 'nectarine', 'courgette', 'raisin sec'],
		4 => ['Salade'],
		5 => ['brioche', 'petit pain', 'pain burger', 'madeleine', 'pain', 'lait', 'oeuf', 'beurre', 'camembert', 'brie', 'charcuterie seche', 'yaourt', 'mousse chocolat'],
		6 => ['pizza', 'glace'],
		7 => ['pâtes', 'riz', 'haricot vert', 'tomate pelée', 'champignon', 'cacahuete', 'chips', 'mayonnaise', 'soupe'],
		8 => ['confiture', 'nutella', 'café', 'filtre à café', 'cereales', 'biscuit', 'chocolat en poudre', 'farine', 'sucre'],
		9 => ['lait', 'eau', 'coca', 'jus de fruit', 'biere', 'vin', 'champagne'],
		10 => ['tampon', 'serviette', 'savon corps', 'shampooing', 'brosse a dent', 'dentifrice', 'papier hygienique', 'mouchoir'],
		11 => ['sopalin', 'lingette SOL_SOCKETlessive', 'liquide vaiselle', 'sac poubelle', 'desodorisant'],
		12 => ['litiere', 'croquettes', 'pâté'],
		13 => ['ampoule', 'presse', 'piles', 'allumette', 'collant', 'chaussette']
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		factory(Categorie::class, 12)->create()->each(function($c) {
			$c->nom = array_pop( DatabaseSeeder::$categories );
			$c->save();
			foreach (self::$produits[$c->id] as $produit) {
				$c->produits()->create([
					'categorie_id'	=> $c->id,
					'nom'			=> $produit,
					'description'	=> $produit.' : '.str_random( rand(5, 125) ),
					'quantite'		=> rand(0, 10),
					'quantite_min'	=> rand(0, 5)
				]);
			}
		});

		//factory(Produit::class, 50)->create();
		factory(Operation::class, 150)->create();

        Model::reguard();
    }
}

