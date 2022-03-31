<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function(Blueprint $table){
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('quantity')->unsigned();
			$table->enum('operation', ['+', '-'])->default('+');
			$table->string('detail');
			$table->timestamps();

			// $table->foreign('produit_id')
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
        Schema::drop('operations');
    }
}
