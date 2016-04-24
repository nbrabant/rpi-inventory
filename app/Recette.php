<?php

namespace App;

use Image;
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

	public function getImage() {
		if(is_null($this->visuel) || !is_file('public/img/recette/'.$this->visuel)) {
			return '';
		}
		return Image::make('public/img/recette/'.$this->visuel);
	}
}
