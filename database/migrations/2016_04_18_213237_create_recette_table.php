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
		Schema::create('recipes', function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->enum('recipe_type', ['entrée', 'plat', 'dessert']);
			$table->text('visual')->nullable();
			$table->string('number_people')->nullable();
			$table->integer('preparation_time')->nullable();
			$table->integer('cooking_time')->nullable();
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
        Schema::drop('recipes');
    }
}
