<?php

namespace App\Domain\Recipe\Entities;

use App\Domain\Schedule\Entities\Schedule;
use Image;
use Illuminate\Database\Eloquent\Model;

// use App\Helpers\CrawlerTraitHelper;

class Recipe extends Model
{
    // use CrawlerTraitHelper;

    protected $fillable = [
        'name',
        'recipe_type',
        'visual',
        'number_people',
        'preparation_time',
        'cooking_time',
        'complement',
    ];

    public function plannings()
    {
        return $this->hasMany(Schedule::class);
    }

    public function products()
    {
        return $this->hasMany(RecipeProduct::class);
    }

    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public static function getList($emptyLine = false)
    {
        $return = [];
        if ($emptyLine) {
            $return['-1'] = '---';
        }

        static::get()->map(function ($item) use (&$return) {
            $return[$item->id] = $item->name;
        });
        return $return;
    }

    public function getImage()
    {
        if (!is_null($this->visual) && is_file(public_path().'/img/recettes/'.$this->visual)) {
            return '<img src="/img/recettes/'.$this->visual.'" class="img-responsive"/>';
        }
        return null;
    }
}
