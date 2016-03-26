<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listecourante extends Model
{
	protected $table = 'listecouranteview';

	protected $fillable = [
		'liste_id',
		'categorie',
		'cat_position',
		'produit',
		'quantite'
	];

    public $timestamps = false;
}
