<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipe_id');
            $table->string('name');
            $table->text('instruction')->nullable();
            $table->integer('position')->default(255);
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('instructions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_steps');

        Schema::table('recipes', function (Blueprint $table) {
            $table->text('instructions');
        });
    }
}
