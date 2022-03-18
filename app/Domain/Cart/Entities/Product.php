<?php

namespace App\Domain\Cart\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property Category $category
 */
class Product extends Eloquent
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return HasMany
     */
    public function productLine(): HasMany
    {
        return $this->hasMany(ProductLine::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}