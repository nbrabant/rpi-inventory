<?php

namespace App\Domain\Recipe\Entities;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\ValueObject\Quantity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int product_id
 * @property string|null unit
 * @property int quantity
 * @property Product $product
 * @property string $stock
 */
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
     * @return BelongsTo
     */
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
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
     * @param $value
     * @return string
     */
    public function getStockAttribute($value): string
    {
        return (string)new Quantity($this->quantity, $this->unit);
    }

    /**
     * @TODO : Refactoring this!!! use value object
     *
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
        }

        if (in_array(strtolower($unit), ['l', 'litres'])) {
            return 'litre';
        }

        if (in_array(strtolower($unit), ['cl', 'centilitres'])) {
            return 'centilitre';
        }

        if (in_array(strtolower($unit), ['cuill??re ?? caf??', 'cuill??res ?? caf??', 'cuill??re caf??', 'cuill??res caf??'])) {
            return 'cuilliere_cafe';
        }

        if (in_array(strtolower($unit), ['cuill??re ?? dessert', 'cuill??re ?? dessert', 'cuill??re dessert', 'cuill??re dessert'])) {
            return 'cuilliere_dessert';
        }

        if (in_array(strtolower($unit), ['cuill??re ?? soupe', 'cuill??res ?? soupe', 'cuill??re soupe', 'cuill??res soupe'])) {
            return 'cuilliere_soupe';
        }

        if (in_array(strtolower($unit), ['verre ?? liqueur', 'verres ?? liqueur', 'verre liqueur', 'verres liqueur'])) {
            return 'verre_liqueur';
        }

        if (in_array(strtolower($unit), ['verre ?? moutarde', 'verres ?? moutarde', 'verre moutarde', 'verres moutarde'])) {
            return 'verre_moutarde';
        }

        if (in_array(strtolower($unit), ['grand verre', 'grand verres'])) {
            return 'grand_verre';
        }

        if (in_array(strtolower($unit), ['tasse ?? caf??', 'tasses ?? caf??', 'tasse caf??', 'tasses caf??'])) {
            return 'tasse_cafe';
        }

        if (in_array(strtolower($unit), ['bols'])) {
            return 'bol';
        }

        if (in_array(strtolower($unit), ['sachets'])) {
            return 'sachet';
        }

        if (in_array(strtolower($unit), ['gousses'])) {
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

        $array['name'] = $this->product->name ?? '';
        $array['stock'] = $this->stock;

        return $array;
    }
}
