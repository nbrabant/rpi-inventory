<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixColumnName extends Migration
{
    protected $tables = [
        'categories' => [
            ['currentname' => 'nom', 'newname' => 'name'],
        ],
        'products' => [
            ['currentname' => 'categorie_id', 'newname' => 'category_id'],
            ['currentname' => 'nom', 'newname' => 'name'],
            ['currentname' => 'quantite', 'newname' => 'quantity'],
            ['currentname' => 'quantite_min', 'newname' => 'min_quantity'],
            ['currentname' => 'unite', 'newname' => 'unit'],
        ],
        'operations' => [
            ['currentname' => 'produit_id', 'newname' => 'product_id'],
            ['currentname' => 'quantite', 'newname' => 'quantity'],
        ],
        'carts' => [
            ['currentname' => 'termine', 'newname' => 'finished'],
        ],
        'product_lines' => [
            ['currentname' => 'liste_id', 'newname' => 'cart_id'],
            ['currentname' => 'produit_id', 'newname' => 'product_id'],
            ['currentname' => 'quantite', 'newname' => 'quantity'],
        ],
        'recipes' => [
            ['currentname' => 'nom', 'newname' => 'name'],
            ['currentname' => 'type_recette', 'newname' => 'recipe_type'],
            ['currentname' => 'visuel', 'newname' => 'visual'],
            ['currentname' => 'nombre_personnes', 'newname' => 'number_people'],
            ['currentname' => 'temps_preparation', 'newname' => 'preparation_time'],
            ['currentname' => 'temps_cuisson', 'newname' => 'cooking_time'],
        ],
        'recipe_products' => [
            ['currentname' => 'recette_id', 'newname' => 'recipe_id'],
            ['currentname' => 'produit_id', 'newname' => 'product_id'],
            ['currentname' => 'quantite', 'newname' => 'quantity'],
            ['currentname' => 'unite', 'newname' => 'unit'],
        ],
        'plannings' => [
            ['currentname' => 'recette_id', 'newname' => 'recipe_id'],
            ['currentname' => 'date_recette', 'newname' => 'date_recipe'],
            ['currentname' => 'realise', 'newname' => 'finished'],
        ],
    ];

    public function up()
    {
        foreach ($this->tables as $tableName => $fields) {
            foreach ($fields as $field) {
                Schema::table($tableName, function($t) use($field) {
                    $t->renameColumn($field['currentname'], $field['newname']);
                });
            }
        }
    }

    public function down()
    {
        foreach ($this->tables as $tableName => $fields) {
            foreach ($fields as $field) {
                Schema::table($tableName, function($t) use($field) {
                    $t->renameColumn($field['newname'], $field['currentname']);
                });
            }
        }
    }

}
