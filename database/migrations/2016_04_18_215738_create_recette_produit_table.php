<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// see : http://tout-metz.com/recette/conversion-unite-cuisine

class CreateRecetteProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('recipe_products', function(Blueprint $table){
			$table->increments('id');
			$table->integer('recipe_id');
			$table->integer('product_id');
			$table->integer('quantity');
			$table->enum('unit', [
				'grammes',
				'litre',
				'centilitre',
				'sachet',
				'gousse',
				'cuilliere_cafe',
				'cuilliere_dessert',
				'cuilliere_soupe',
				'verre_liqueur',
				'verre_moutarde',
				'tasse_cafe',
				'grand_verre',
				'bol',
			])->nullable()->default(null);

			// $table->foreign('recipe_id')
			// 	->references('id')->on('recipes')
			// 	->onDelete('cascade');
			//
			// $table->foreign('product_id')
			// 	->references('id')->on('products')
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
        Schema::drop('recipe_products');
    }
}
