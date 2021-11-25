<?php

namespace App\Domain\Recipe\Entities;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Stock\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeProduct extends Model implements RecipeInterface
{
    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'recipe_id',
        'product_id',
        'quantity',
        'unit',
    ];

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @TODO : Schedule domain responsability
     *
     * @return BelongsTo
     */
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * @TODO : Stock domain responsability
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return mixed[]
     */
    public static function getUniteList(): array
    {
        return self::UNITS_LIST;
    }

    /**
     * @return string
     */
    public function getUnite(): string
    {
        return self::getUniteList()[$this->unite];
    }

    /**
     * verbose unity
     *
     * convert quantity
     * http://tout-metz.com/recette/conversion-unite-cuisine
     * @return float
     */
    public function getQuantity(): float
    {
        if (self::UNIT_QUANTITY_RATIO[$this->getUnite()]) {
            return $this->quantity * self::UNIT_QUANTITY_RATIO[$this->getUnite()];
        }

        return $this->quantity;
    }

    /**
     * @param string $unite
     * @return string
     */
    public static function verboseUnite($unite = ''): string
    {
        if ($arrayName = array_key_exists(strtolower($unite), self::getUniteList())) {
            return $unite;
        }

        if (in_array(strtolower($unite), ['g', 'grs', 'gramme'])) {
            return 'grammes';
        } elseif (in_array(strtolower($unite), ['l', 'litres'])) {
            return 'litre';
        } elseif (in_array(strtolower($unite), ['cl', 'centilitres'])) {
            return 'centilitre';
        } elseif (in_array(strtolower($unite), ['cuillère à café', 'cuillères à café', 'cuillère café', 'cuillères café'])) {
            return 'cuilliere_cafe';
        } elseif (in_array(strtolower($unite), ['cuillère à dessert', 'cuillère à dessert', 'cuillère dessert', 'cuillère dessert'])) {
            return 'cuilliere_dessert';
        } elseif (in_array(strtolower($unite), ['cuillère à soupe', 'cuillères à soupe', 'cuillère soupe', 'cuillères soupe'])) {
            return 'cuilliere_soupe';
        } elseif (in_array(strtolower($unite), ['verre à liqueur', 'verres à liqueur', 'verre liqueur', 'verres liqueur'])) {
            return 'verre_liqueur';
        } elseif (in_array(strtolower($unite), ['verre à moutarde', 'verres à moutarde', 'verre moutarde', 'verres moutarde'])) {
            return 'verre_moutarde';
        } elseif (in_array(strtolower($unite), ['grand verre', 'grand verres'])) {
            return 'grand_verre';
        } elseif (in_array(strtolower($unite), ['tasse à café', 'tasses à café', 'tasse café', 'tasses café'])) {
            return 'tasse_cafe';
        } elseif (in_array(strtolower($unite), ['bols'])) {
            return 'bol';
        } elseif (in_array(strtolower($unite), ['sachets'])) {
            return 'sachet';
        } elseif (in_array(strtolower($unite), ['gousses'])) {
            return 'gousse';
        }

        return $unite;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();

        $array['product_name'] = $this->product->name ?? '';
        $array['product_quantity'] = $this->quantity . ' ' . $this->getQuantity();

        return $array;
    }
}
