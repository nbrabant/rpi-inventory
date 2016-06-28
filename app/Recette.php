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

	public static function getList($emptyLine = true)
	{
		$return = [];
		if($emptyLine) {
			$return['-1'] = '---';
		}

        static::get()->map(function($item) use (&$return) {
            $return[$item->id] = $item->nom;
        });
        return $return;
	}

	public function getImage() {
		if(!is_null($this->visuel) && is_file(public_path().'/img/recettes/'.$this->visuel)) {
			return '<img src="/img/recettes/'.$this->visuel.'" class="img-responsive"/>';
		}
		return null;
	}

	public function syncProducts($postDatas = []) {
		$lstToAdd = [];
		$this->produits->map(function($produit) use(&$postDatas) {
			// delete if product not in
			if(!isset($postDatas['produits']) || !is_array($postDatas['produits']) || !in_array($produit->produit_id, $postDatas['produits'])) {
				$produit->delete();
			}

			// update recette_produit row
			if(isset($postDatas['quantite_'.$produit->produit_id]) && $postDatas['quantite_'.$produit->produit_id] > 0) { // for security
				$produit->quantite 	= $postDatas['quantite_'.$produit->produit_id];
				$produit->unite		= (isset($postDatas['unite_'.$produit->produit_id]) && strlen($postDatas['unite_'.$produit->produit_id]) > 0 ? $postDatas['unite_'.$produit->produit_id] : null);
				$produit->save();
			}

			// unset all the postDatas produit where $key is $recette_produit product ID
			foreach ($postDatas['produits'] as $key => $produitId) {
				if($produit->produit_id == $produitId) {
					unset($postDatas['produits'][$key]);
				}
			}
		});

		// after that, create the other recette_produit relation if it needed
		if(isset($postDatas['produits']) && is_array($postDatas['produits']) && !empty($postDatas['produits'])) {
			foreach ($postDatas['produits'] as $produitId) {
				if(!isset($postDatas['quantite_'.$produitId]) || $postDatas['quantite_'.$produitId] <= 0) {
					continue;
				}

				$lstToAdd[] = new RecetteProduit([
					'produit_id'	=> $produitId,
					'quantite'		=> $postDatas['quantite_'.$produitId],
					'unite' 		=> (isset($postDatas['unite_'.$produitId]) && strlen($postDatas['unite_'.$produitId]) > 0 ? $postDatas['unite_'.$produitId] : null)
				]);
			}
		}

		if(is_array($lstToAdd) && !empty($lstToAdd)) {
			$this->produits()->saveMany( $lstToAdd );
		}
	}
}
