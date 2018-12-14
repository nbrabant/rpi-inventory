<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductLine extends Eloquent
{
    public function __toString()
    {
        return $this->quantity . ' ' . $this->unity . ' ' . $this->product;
    }

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
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
