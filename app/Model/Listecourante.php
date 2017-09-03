<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Listecourante extends Model
{
	protected $table = 'listecouranteView';

	protected $fillable = [
		'liste_id',
		'categorie',
		'cat_position',
		'produit',
		'quantite',
		'unite',
	];

    public $timestamps = false;
}