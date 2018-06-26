<?php

namespace App\Repositories\Recipe;

use Carbon\Carbon;
use App\Repositories\Repository;
use \App\Models\Recipe as Recipe;
use \App\Helpers\ParseHelper;

class RecipeRepository extends Repository
{
    protected $with = ['products', 'steps'];

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
        $this->syncSteps($object, reset($attributes['steps']));

        return $object->load($this->with);
    }

    public function update(array $attributes, $id)
    {
        if (array_key_exists('id', $attributes)) {
            unset($attributes['id']);
        }

        $object = $this->model->findOrFail($id);
        $this->syncProducts($object, reset($attributes['products']));
        $this->syncSteps($object, reset($attributes['steps']));
        $object->fill($attributes)->save();

        $object->load($this->with);

        return $object;
    }

    public function syncProducts(Recipe $recipe, array $products = []) {
        $productsList = ParseHelper::arrayRequestToArray($products);

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

    protected function syncSteps(Recipe $recipe, array $steps = [])
    {
        $stepsList = ParseHelper::arrayRequestToArray($steps);

        $recipe->steps->map(function($recipeStep) use(&$stepsList) {
            $found = array_filter($stepsList, function($step) use($recipeStep) {
                return $step['id'] == $recipeStep->id;
            });

            // delete if product not in
			if (empty($found)) {
                $recipeStep->delete();
                return true;
            }

			// update recette_produit row
			$recipeStep->fill(reset($found));
            $recipeStep->save();

			// unset all the postDatas produit where $key is $recette_produit product ID
			$stepsList = array_filter($stepsList, function($step) use($recipeStep) {
                return $step['id'] != $recipeStep->id;
            });
        });

        // after that, create the other recette_produit relation if it needed
        $listToAdd = [];
        foreach ($stepsList as $step) {
            if ($step['name']) {
                $listToAdd[] = new \App\Models\RecipeStep($step);
            }
        };

		// and finally, save
		if (is_array($listToAdd) && !empty($listToAdd)) {
			$recipe->steps()->saveMany($listToAdd);
		}
    }

}
