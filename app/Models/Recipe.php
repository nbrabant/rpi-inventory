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
		return $this->hasMany('App\Models\Planning');
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
