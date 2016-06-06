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
	public function agendas() {
		return $this->hasMany('App\Agenda');
	}

	public function produits() {
		return $this->hasMany('App\RecetteProduit');
	}

	public function getValidators()
	{
		return $this->validators;
	}

	public function getImage() {
		try {
			if(is_null($this->visuel) || !is_file(public_path().'/img/recettes/'.$this->visuel)) {
				return '';
			}
			return Image::make(public_path().'/img/recettes/'.$this->visuel);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
