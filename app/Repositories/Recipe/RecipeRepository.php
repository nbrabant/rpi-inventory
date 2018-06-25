<?php

namespace App\Repositories\Recipe;

use Carbon\Carbon;
use App\Repositories\Repository;
use \App\Models\Recipe as Recipe;

use Illuminate\Support\Facade\Log;

class RecipeRepository extends Repository
{
    protected $with = ['products'];

    public function model() {
        return \App\Models\Recipe::class;
    }

    public function initialize()
    {
        return new $this->model();
    }

    public function create(array $attributes)
    {
        $object = $this->model->create($attributes);
        $this->syncProducts($object, reset($attributes['products']));

        return $object->load($this->with);
    }

    public function update(array $attributes, $id)
    {
        if (array_key_exists('id', $attributes)) {
            unset($attributes['id']);
        }

        $object = $this->model->findOrFail($id);
        $this->syncProducts($object, reset($attributes['products']));
        $object->fill($attributes)->save();

        $object->load($this->with);

        return $object;
    }

    public function syncProducts(Recipe $recipe, array $products = []) {
        // map $postdatas to productlist
        $productsList = [];
        foreach ($products as $column => $values) {
            foreach ($values as $key => $value) {
                @$productsList[$key][$column] = $value;
            }
        };

        $recipe->products->map(function($recipeProduct) use(&$productsList) {
            $found = array_filter($productsList, function($product) use($recipeProduct) {
                return $product['product_id'] == $recipeProduct->product_id;
            });

			// delete if product not in
			if (empty($found)) {
                $recipeProduct->delete();
                return true;
            }

			// update recette_produit row
			$recipeProduct->fill(reset($found));
            $recipeProduct->save();

			// unset all the postDatas produit where $key is $recette_produit product ID
			$productsList = array_filter($productsList, function($product) use($recipeProduct) {
                return $product['product_id'] != $recipeProduct->product_id;
            });
		});

		// after that, create the other recette_produit relation if it needed
        $listToAdd = [];
        foreach ($productsList as $product) {
            if ($product['product_id'] && $product['quantity']) {
                $listToAdd[] = new \App\Models\RecipeProduct($product);
            }
        };

		// and finally, save
		if (is_array($listToAdd) && !empty($listToAdd)) {
			$recipe->products()->saveMany($listToAdd);
		}
	}

}
