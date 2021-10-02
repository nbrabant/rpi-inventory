<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSchedulesStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('recipe_id');
            $table->dropColumn('date_recipe');
            $table->dropColumn('moment');
            $table->dropColumn('finished');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('schedules', function (Blueprint $table) {
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
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('type_schedule');
            $table->dropColumn('title');
            $table->dropColumn('details');
            $table->dropColumn('all_day');
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->date('date_recipe')->default("1970-01-01");
            $table->text('moment');
            $table->boolean('finished');
        });
    }
}
