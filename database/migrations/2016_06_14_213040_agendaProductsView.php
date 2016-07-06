<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgendaProductsView extends Migration
{
    public function up()
    {
		// "SELECT
        //     p.id AS produit_id,
        //     p.nom AS produit_nom,
        //     SUM(np.necessaire) AS necessaire,
        //     p.quantite AS en_stock,
        //     (SUM(np.necessaire) - p.quantite) AS manquant,
        //     p.unite
        // FROM (
        //     SELECT
        //         rp.produit_id AS produit_id,
        //         case rp.unite
        //             WHEN 'centilitre' then rp.quantite * 0.01
        //             WHEN 'cuillere_cafe' then rp.quantite * 4
        //             WHEN 'cuillere_dessert' then rp.quantite * 8
        //             WHEN 'cuillere_soupe' then rp.quantite * 12
        //             WHEN 'verre_liqueur' then rp.quantite * 0.03
        //             WHEN 'tasse_cafe' then rp.quantite * 0.1
        //             WHEN 'verre_moutarde' then rp.quantite * 0.15
        //             WHEN 'grand_verre' then rp.quantite * 0.25
        //             WHEN 'bol' then rp.quantite * 0.35
        //             ELSE rp.quantite
        //         end as necessaire
        //     FROM agendas AS a
        //     LEFT JOIN recettes_produits AS rp ON (rp.recette_id = a.recette_id)
        //     WHERE (
        //         a.date_recette
        //         BETWEEN adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY)
        //         AND adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY))
        // ) as np
        // LEFT JOIN produits AS p ON (p.id = np.produit_id)
        // GROUP BY p.id";


		DB::statement("CREATE OR REPLACE VIEW necessaireProductsView AS
						SELECT
							rp.produit_id AS produit_id,
							case rp.unite
								WHEN 'centilitre' then rp.quantite * 0.01
								WHEN 'cuillere_cafe' then rp.quantite * 4
								WHEN 'cuillere_dessert' then rp.quantite * 8
								WHEN 'cuillere_soupe' then rp.quantite * 12
								WHEN 'verre_liqueur' then rp.quantite * 0.03
								WHEN 'tasse_cafe' then rp.quantite * 0.1
								WHEN 'verre_moutarde' then rp.quantite * 0.15
								WHEN 'grand_verre' then rp.quantite * 0.25
								WHEN 'bol' then rp.quantite * 0.35
								ELSE rp.quantite
							end as necessaire
						FROM agendas AS a
						LEFT JOIN recettes_produits AS rp ON (rp.recette_id = a.recette_id)
						WHERE (
							a.date_recette
							BETWEEN adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY)
							AND adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY))");

		DB::statement("CREATE OR REPLACE VIEW agendaProductsView AS
						SELECT
							p.id AS produit_id,
							p.nom AS produit_nom,
							SUM(np.necessaire) AS necessaire,
							p.quantite AS en_stock,
							(SUM(np.necessaire) - p.quantite) AS manquant,
							p.unite
						FROM necessaireProductsView as np
						LEFT JOIN produits AS p ON (p.id = np.produit_id)
						GROUP BY p.id");
    }

    public function down()
    {
        // Schema::drop('agendaProductsView');
    }
}
