<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTableName extends Migration
{
    public function up()
    {
        $this->changeTableName('produits',          'products');
        $this->changeTableName('lignes_produits',   'product_lines');
        $this->changeTableName('listes',            'carts');
        $this->changeTableName('recettes',          'recipes');
        $this->changeTableName('recettes_produits', 'recipe_products');
        $this->changeTableName('agendas',           'schedules');
    }

    public function down()
    {
        $this->changeTableName('products',          'produits');
        $this->changeTableName('product_lines',     'lignes_produits');
        $this->changeTableName('carts',             'listes');
        $this->changeTableName('recipes',           'recettes');
        $this->changeTableName('recipe_products',   'recettes_produits');
        $this->changeTableName('schedules',         'agendas');
    }

    protected function changeTableName($table, $newname)
    {
        return DB::statement('RENAME TABLE `'.$table.'` TO `'.$newname.'`');
    }
}
