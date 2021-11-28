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
    public static function getUnitList(): array
    {
        return self::UNITS_LIST;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return self::getUnitList()[$this->unit] ?? $this->unit;
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
        if (isset(self::UNIT_QUANTITY_RATIO[$this->unit])) {
            return $this->quantity * self::UNIT_QUANTITY_RATIO[$this->unit];
        }

        return $this->quantity;
    }

    /**
     * @param string $unit
     * @return string
     */
    public static function verboseUnite($unit = ''): string
    {
        if (array_key_exists(strtolower($unit), self::getUnitList())) {
            return $unit;
        }

        if (in_array(strtolower($unit), ['g', 'grs', 'gramme'])) {
            return 'grammes';
        } elseif (in_array(strtolower($unit), ['l', 'litres'])) {
            return 'litre';
        } elseif (in_array(strtolower($unit), ['cl', 'centilitres'])) {
            return 'centilitre';
        } elseif (in_array(strtolower($unit), ['cuillère à café', 'cuillères à café', 'cuillère café', 'cuillères café'])) {
            return 'cuilliere_cafe';
        } elseif (in_array(strtolower($unit), ['cuillère à dessert', 'cuillère à dessert', 'cuillère dessert', 'cuillère dessert'])) {
            return 'cuilliere_dessert';
        } elseif (in_array(strtolower($unit), ['cuillère à soupe', 'cuillères à soupe', 'cuillère soupe', 'cuillères soupe'])) {
            return 'cuilliere_soupe';
        } elseif (in_array(strtolower($unit), ['verre à liqueur', 'verres à liqueur', 'verre liqueur', 'verres liqueur'])) {
            return 'verre_liqueur';
        } elseif (in_array(strtolower($unit), ['verre à moutarde', 'verres à moutarde', 'verre moutarde', 'verres moutarde'])) {
            return 'verre_moutarde';
        } elseif (in_array(strtolower($unit), ['grand verre', 'grand verres'])) {
            return 'grand_verre';
        } elseif (in_array(strtolower($unit), ['tasse à café', 'tasses à café', 'tasse café', 'tasses café'])) {
            return 'tasse_cafe';
        } elseif (in_array(strtolower($unit), ['bols'])) {
            return 'bol';
        } elseif (in_array(strtolower($unit), ['sachets'])) {
            return 'sachet';
        } elseif (in_array(strtolower($unit), ['gousses'])) {
            return 'gousse';
        }

        return $unit;
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
