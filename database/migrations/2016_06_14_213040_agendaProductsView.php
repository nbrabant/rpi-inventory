<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgendaProductsView extends Migration
{
    public function up()
    {
		DB::statement("CREATE OR REPLACE VIEW agendaProductsView AS
						SELECT
							p.id AS id,
							p.nom AS nom,
							SUM(rp.quantite) AS necessaire,
							p.quantite AS en_stock,
							(SUM(rp.quantite) - p.quantite) AS manquant
						FROM agendas AS a
						LEFT JOIN recettes_produits AS rp ON (rp.recette_id = a.recette_id)
						LEFT JOIN produits AS p ON (p.id = rp.produit_id)
						WHERE (
							a.date_recette
							BETWEEN adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY)
							AND adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY))
						GROUP BY p.id");
    }

    public function down()
    {
        // Schema::drop('agendaProductsView');
    }
}
