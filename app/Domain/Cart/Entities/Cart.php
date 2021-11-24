<?php

namespace App\Domain\Cart\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Domain\Cart\Helpers\TrelloTraitHelper;
use App\Domain\Cart\Contracts\CartInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Eloquent implements CartInterface
{
    use TrelloTraitHelper;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'finished',
        'trello_card_id'
    ];

    /**
     * @return HasMany
     */
    public function productLines(): HasMany
    {
        return $this->hasMany(ProductLine::class);
    }

    /**
     * @return int[]
     */
    public function getProductListIds(): array
    {
        return $this->productLines()->lists('product_id')->toArray();
    }

    /**
     * @return Collection
     */
    public function getProductsOrderedByCategory(): Collection
    {
        return $this->productLines()->with([
            'product',
            'product.category' => function ($query) {
                $query->orderBy('position', 'ASC');
            }
        ])->get();
    }
}
