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
		Schema::create('schedules', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('recipe_id')->nullable();
            $table->integer('user_id')->default(1);
            $table->enum('type_schedule', ['recette', 'rendezvous', 'planning']);
            $table->string('title');
            $table->text('details')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->boolean('all_day')->default(0);
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
        Schema::drop('schedules');
    }
}
