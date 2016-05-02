<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('recettes', function(Blueprint $table){
			$table->increments('id');
			$table->string('nom');
			$table->enum('type_recette', ['entrée', 'plat', 'dessert']);
			$table->text('visuel')->nullable();
			$table->text('instructions');
			$table->string('nombre_personnes')->nullable();
			$table->integer('temps_preparation')->nullable();
			$table->integer('temps_cuisson')->nullable();
			$table->text('complement')->nullable();
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recettes');
    }
}
