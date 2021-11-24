<?php

namespace App\Domain\Cart\Entities;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\ProductLineInterface;
use App\Domain\Stock\Entities\Category;
use App\Domain\Stock\Entities\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;

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
     * @return CartInterface
     */
    public function cart(): CartInterface
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @TODO : Stock domain responsability
     *
     * @return Product
     */
    public function product(): Product
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @TODO : Stock domain responsability
     *
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
