<?php

namespace App\Models;

use Image;
use Illuminate\Database\Eloquent\Model;
// use App\Helpers\CrawlerTraitHelper;

class Recipe extends Model
{
	// use CrawlerTraitHelper;

	//columns
    protected $fillable = [
		'name',
		'recipe_type',
		'visual',
		'instructions', // @TODO : split instructions into recipe_steps
		'number_people',
		'preparation_time',
		'cooking_time',
		'complement',
	];

	//hierarchical
	public function plannings()
	{
		return $this->hasMany('App\Planning');
	}

	public function products()
	{
		return $this->hasMany('App\Models\RecipeProduct');
	}

	public static function getList($emptyLine = false)
	{
		$return = [];
		if($emptyLine) {
			$return['-1'] = '---';
		}

        static::get()->map(function($item) use (&$return) {
            $return[$item->id] = $item->name;
        });
        return $return;
	}

	public function getImage() {
		if(!is_null($this->visual) && is_file(public_path().'/img/recettes/'.$this->visual)) {
			return '<img src="/img/recettes/'.$this->visual.'" class="img-responsive"/>';
		}
		return null;
	}

	public function syncProducts($postDatas = []) {
		$lstToAdd = [];
		$this->produits->map(function($produit) use(&$postDatas) {
			// delete if product not in
			if(!isset($postDatas['produits']) || !is_array($postDatas['produits']) || !in_array($produit->product_id, $postDatas['produits'])) {
				$produit->delete();
			}

			// update recette_produit row
			if(isset($postDatas['quantite_'.$produit->product_id]) && $postDatas['quantite_'.$produit->product_id] > 0) { // for security
				$produit->quantite 	= $postDatas['quantite_'.$produit->product_id];
				$produit->unite		= (isset($postDatas['unite_'.$produit->product_id]) && strlen($postDatas['unite_'.$produit->product_id]) > 0 ? $postDatas['unite_'.$produit->product_id] : null);
				$produit->save();
			}

			// unset all the postDatas produit where $key is $recette_produit product ID
			foreach ($postDatas['produits'] as $key => $produitId) {
				if($produit->product_id == $produitId) {
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
					'product_id'	=> $produitId,
					'quantite'		=> $postDatas['quantite_'.$produitId],
					'unite' 		=> (isset($postDatas['unite_'.$produitId]) && strlen($postDatas['unite_'.$produitId]) > 0 ? $postDatas['unite_'.$produitId] : null)
				]);
			}
		}

		// and finally, save
		if(is_array($lstToAdd) && !empty($lstToAdd)) {
			$this->produits()->saveMany( $lstToAdd );
		}
	}

	public function getStepsAttribute()
	{
		$return = [];
		foreach (explode("\r", str_replace(['<p>', '</p>'], "\r", $this->instructions)) as $step) {
			if (strlen(trim($step)) > 0) {
				$return[] = $step;
			}
		}

		return $return;
	}
}
