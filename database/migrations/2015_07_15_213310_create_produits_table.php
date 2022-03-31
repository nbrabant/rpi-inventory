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
        Schema::create('products', function(Blueprint $table){
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->string('name');
			$table->text('description')->nullable();
			$table->integer('quantity')->unsigned();
			$table->integer('min_quantity')->unsigned()->default(0);
			$table->enum('unit', [
                'piece',
                'grammes',
				'litre',
				'sachet',
			])->nullable();
			$table->timestamps();

			// $table->foreign('categorie_id')
			// 	->references('id')->on('categories')
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
        Schema::drop('products');
    }
}
