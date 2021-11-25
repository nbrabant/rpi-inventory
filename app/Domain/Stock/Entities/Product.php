<?php

namespace App\Domain\Stock\Entities;

use App\Domain\Recipe\Entities\RecipeProduct;
use App\Domain\Cart\Entities\ProductLine;
use App\Domain\Stock\Contracts\ProductInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Product extends Eloquent implements ProductInterface
{
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
     * @return HasMany
     */
    public function productLine(): HasMany
    {
        return $this->hasMany(ProductLine::class);
    }

    /**
     * @return HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(RecipeProduct::class);
    }

    /**
     * @param Builder $query
     * @param array $ids
     * @return Builder
     */
    public function scopeWithoutIds(Builder $query, array $ids = []): Builder
    {
        if (is_array($ids) && !empty($ids)) {
            $query->whereNotIn('id', $ids);
        }
        return $query;
    }

    /**
     * @param null $withoutId
     * @param bool $emptyLine
     * @return array
     */
    public static function getList($withoutId = null, bool $emptyLine = true): array
    {
        $return = [];
        if ($emptyLine) {
            $return['-1'] = '---';
        }

        static::without($withoutId)->get()->map(function ($item) use (&$return) {
            $return[$item->id] = $item->name;
        });

        return $return;
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

    public function getUniteList()
    {
        return [
            '' 			=> '---',
            'grammes' 	=> 'Grammes',
            'litre' 	=> 'Litre',
            'sachet' 	=> 'Sachet'
        ];
    }

    public function toArray()
    {
        $datas = parent::toArray();

        $datas['status'] = $this->getStatus();

        return $datas;
    }
}
