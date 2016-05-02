<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CrawlerTraitHelper;

class Recette extends Model
{
	use CrawlerTraitHelper;

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
		'complement',
	];

	protected $validators = [
		'nom'				=> 'required',
		'instructions'		=> 'required',
		'nombre_personnes'	=> 'required|string|max:64',
		'temps_preparation'	=> 'integer',
		'temps_cuisson'		=> 'integer',
		'complement'		=> 'string',
	];

	//hierarchical
	public function produits() {
		return $this->hasMany('App\RecetteProduit');
	}

	public function getValidators()
	{
		return $this->validators;
	}

	public function getImage() {
var_dump('public/img/recette/'.$this->visuel);
		if(is_null($this->visuel) || !is_file('public/img/recette/'.$this->visuel)) {
			return '';
		}
		return Image::make('public/img/recette/'.$this->visuel);
	}
}
