<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLignesproduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_produits', function(Blueprint $table){
			$table->increments('id');
			$table->integer('liste_id')->unsigned();
			$table->integer('produit_id')->unsigned();
			$table->float('quantite');
			$table->timestamps();

			// $table->foreign('liste_id')
			// 	->references('id')->on('listes')
			// 	->onDelete('cascade');

			// $table->foreign('produit_id')
			// 	->references('id')->on('produits')
			// 	->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lignes_produits');
    }
}
