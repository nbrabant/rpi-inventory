<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendaproducts extends Model
{
    protected $table = 'agendaProductsView';

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
