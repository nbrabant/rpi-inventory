<?php

namespace App\Domain\Recipe\Entities;

use App\Infrastructure\Entities\Traits\Listable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property int quantity
 * @property int min_quantity
 */
class Product extends Eloquent
{
    use Listable;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(RecipeProduct::class);
    }

    /**
     * @return string[]
     */
    public function getUniteList(): array
    {
        return [
            '' 			=> '---',
            'grammes' 	=> 'Grammes',
            'litre' 	=> 'Litre',
            'sachet' 	=> 'Sachet'
        ];
    }
}
