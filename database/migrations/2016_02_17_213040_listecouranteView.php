<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListecouranteView extends Migration
{
	public function up()
	{
		DB::statement("CREATE OR REPLACE VIEW listecouranteView AS
                        SELECT
							l.id AS liste_id,
							c.nom AS categorie,
							c.position AS cat_position,
							p.nom AS produit,
							lp.quantite AS quantite,
							p.unite AS unite
                        FROM listes AS l
						LEFT JOIN lignes_produits AS lp ON (lp.liste_id = l.id)
						LEFT JOIN produits AS p ON (lp.produit_id = p.id)
						LEFT JOIN categories AS c ON (p.categorie_id = c.id)
						WHERE l.termine = 0
						ORDER BY c.position, c.nom, p.nom");
	}

	public function down()
    {
        // Schema::drop('listecouranteView');
    }
}
