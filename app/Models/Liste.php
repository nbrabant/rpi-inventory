<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Helpers\TrelloTraitHelper;

class Liste extends Eloquent
{
	use TrelloTraitHelper;

	protected $table = 'listes';

	//columns
    protected $fillable = [
		'termine',
		'trello_card_id'
	];

	//hierarchical
	public function lignesproduits()
	{
		return $this->hasMany('App\Ligneproduit');
	}

	public function listecourante() {
		return $this->hasMany('App\Listecourante');
	}

	public function getProductListIds()
	{
		return $this->lignesproduits()->lists('produit_id')->toArray();
	}

	public function getProductsOrderedByCategory()
	{
		return $this->lignesproduits()->with([
			'produit',
			'produit.categorie' => function($query) {
				$query->orderBy('position', 'ASC');
			}
		])->get();
	}
}
