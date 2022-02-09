<?php

namespace App\Domain\Stock\Entities;

use App\Domain\Stock\Contracts\CategoryInterface;
use App\Infrastructure\Entities\Traits\Listable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string name
 */
class Category extends Eloquent implements CategoryInterface
{
    use Listable;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'position'
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @param Builder $query
     * @param string $order
     * @return Builder
     */
    public function scopeByPosition(Builder $query, string $order = 'ASC'): Builder
    {
        if (!in_array($order, ['ASC', 'DESC'])) {
            $order = 'ASC';
        }
        return $query->orderBy('position', $order);
    }
}
