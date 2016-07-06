<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendaproducts extends Model
{
    protected $table = 'agendaproductsview';

	protected $fillable = [
		'produit_id',
		'produit_nom',
		'necessaire',
		'en_stock',
		'manquant',
		'unite',
	];

    public $timestamps = false;
}
