<?php

namespace App\Domain\Recipe\Entities;

use App\Infrastructure\Entities\Traits\Listable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed name
 * @property mixed quantity
 * @property mixed min_quantity
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
     * @var string[] $fillable
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'quantity',
        'min_quantity',
        'unit'
    ];

    /**
     * @return HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(RecipeProduct::class);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        if ($this->min_quantity == 0 || $this->quantity > $this->min_quantity) {
            return self::STATUS_SUCCESS;
        } elseif ($this->quantity == $this->min_quantity) {
            return self::STATUS_WARNING;
        }
        return self::STATUS_DANGER;
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

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $datas = parent::toArray();

        $datas['status'] = $this->getStatus();

        return $datas;
    }
}
