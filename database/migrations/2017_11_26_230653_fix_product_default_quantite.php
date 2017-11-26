<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixProductDefaultQuantite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `produits` CHANGE COLUMN `quantite` `quantite` INTEGER NOT NULL DEFAULT 0');
        DB::statement("ALTER TABLE `produits` CHANGE COLUMN `unite` `unite` ENUM('piece', 'grammes', 'litre', 'sachet') NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() { }
}
