<?php

namespace App\Domain\Cart\Entities;

use App\Domain\Cart\Entities\ProductLine;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Domain\Cart\Helpers\TrelloTraitHelper;
use App\Domain\Cart\Contracts\CartInterface;

class Cart extends Eloquent implements CartInterface
{
    use TrelloTraitHelper;

    protected $fillable = [
        'finished',
        'trello_card_id'
    ];

    public function productLines()
    {
        return $this->hasMany(ProductLine::class);
    }

    public function getProductListIds()
    {
        return $this->productLines()->lists('product_id')->toArray();
    }

    public function getProductsOrderedByCategory()
    {
        return $this->productLines()->with([
            'product',
            'product.category' => function ($query) {
                $query->orderBy('position', 'ASC');
            }
        ])->get();
    }
}
