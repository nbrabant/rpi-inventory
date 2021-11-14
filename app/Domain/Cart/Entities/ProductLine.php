<?php

namespace App\Domain\Cart\Entities;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Stock\Entities\Product;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductLine extends Eloquent
{
    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->quantity, $this->unity, $this->product);;
    }

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getCategory()
    {
        return $this->product->category;
    }

    public function scopeCategoryByPosition($query)
    {
        return $query->with([
            'product',
            'product.category' => function ($query) {
                $query->orderBy('position', 'ASC');
            }
        ]);
    }
}
