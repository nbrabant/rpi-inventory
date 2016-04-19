<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetteProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('recettes_produits', function(Blueprint $table){
			$table->increments('id');
			$table->integer('recette_id');
			$table->integer('produit_id');
			$table->integer('quantite');

			$table->foreign('recette_id')
				->references('id')->on('recettes')
				->onDelete('cascade');

			$table->foreign('produit_id')
				->references('id')->on('produits')
				->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recettes_produits');
    }
}
