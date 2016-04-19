<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
	protected $table = 'recettes';

	//columns
    protected $fillable = [
		'nom',
		'type_recette',
		'visuel',
		'instructions',
		'nombre_personnes',
		'temps_preparation',
		'temps_cuisson',
	];

	//hierarchical
	public function produits() {
		return $this->hasMany('App\RecetteProduit');
	}

}
