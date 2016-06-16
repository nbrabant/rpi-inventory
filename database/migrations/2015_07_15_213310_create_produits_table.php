<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function(Blueprint $table){
			$table->increments('id');
			$table->integer('categorie_id')->unsigned();
			$table->string('nom');
			$table->text('description')->nullable();
			$table->integer('quantite')->unsigned();
			$table->integer('quantite_min')->unsigned()->default(0);
			$table->enum('unite', [
				'grammes',
				'litre',
				'sachet',
			])->nullable();
			$table->timestamps();

			$table->foreign('categorie_id')
				->references('id')->on('categories')
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
        Schema::drop('produits');
    }
}
