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
        Schema::create('product_lines', function(Blueprint $table){
			$table->increments('id');
			$table->integer('cart_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->float('quantity');
			$table->timestamps();

			// $table->foreign('cart_id')
			// 	->references('id')->on('carts')
			// 	->onDelete('cascade');

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
        Schema::drop('product_lines');
    }
}
