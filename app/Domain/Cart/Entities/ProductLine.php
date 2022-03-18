<?php

namespace App\Domain\Cart\Entities;

use App\Domain\Cart\Contracts\ProductLineInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $quantity
 * @property string $unity
 * @property Product $product
 */
class ProductLine extends Eloquent implements ProductLineInterface
{
    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->quantity, $this->unity, $this->product);
    }

    /**
     * @return BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->product->category;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCategoryByPosition(Builder $query): Builder
    {
        return $query->with([
            'product',
            'product.category' => function ($query) {
                $query->orderBy('position', 'ASC');
            }
        ]);
    }
}
