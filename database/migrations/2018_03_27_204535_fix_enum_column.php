<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixEnumColumn extends Migration
{
    public function up()
    {
        $this->fixEnumFormat('products',          'unite');
        $this->fixEnumFormat('operations',        'operation');
        $this->fixEnumFormat('recipes',           'type_recette');
        $this->fixEnumFormat('recipe_products',   'unite');
        $this->fixEnumFormat('schedules',         'moment');
    }

    public function down()
    {
        //
    }

    protected function fixEnumFormat($table, $fieldname)
    {
//        return DB::statement('ALTER TABLE `'.$table.'` CHANGE COLUMN `'.$fieldname.'` `'.$fieldname.'` VARCHAR(255) NULL');
    }
}
