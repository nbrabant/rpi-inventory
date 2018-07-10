<?php

// drop view if exists `agendaProductsView`;
// drop table if exists `carts`;
// drop table if exists `categories`;
// drop view if exists `listecouranteView`;
// drop table if exists `migrations`;
// drop view if exists `necessaireProductsView`;
// drop table if exists `operations`;
// drop table if exists `product_lines`;
// drop table if exists `products`;
// drop table if exists `recipe_products`;
// drop table if exists `recipe_steps`;
// drop table if exists `recipes`;
// drop table if exists `schedules`;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table){
			$table->increments('id');
			$table->string('nom');
			$table->integer('position')->default(255);
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
        Schema::drop('categories');
    }
}
