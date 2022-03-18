<?php

namespace App\Domain\Stock\Entities;

use App\Domain\Stock\Contracts\ProductInterface;
use App\Infrastructure\Entities\Traits\Listable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed name
 * @property mixed quantity
 * @property mixed min_quantity
 */
class Product extends Eloquent implements ProductInterface
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
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class)
            ->orderBy('created_at', 'DESC');
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
     * récup des produits avec stock > stock mini hors produit dans la liste
     *
     * @param array $withoutIds
     * @return array
     */
    public static function getOutOfStockProducts($withoutIds = [])
    {
        return self::withoutIds($withoutIds)
                ->where('min_quantity', '>', 0)
                ->whereRaw('products.quantity <= products.min_quantity')
                ->get();
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
