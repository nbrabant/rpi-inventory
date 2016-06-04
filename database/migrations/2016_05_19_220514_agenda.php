<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('agendas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('recette_id');
			$table->date('date_recette');
			$table->enum('moment', ['matin', 'midi', 'soir']);
			$table->boolean('realise');
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
        Schema::drop('agendas');
    }
}
