<?php

namespace App\Domain\Stock\Entities;

use App\Domain\Stock\Contracts\CategoryInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Category extends Eloquent implements CategoryInterface
{
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

    /**
     * @param bool $emptyLine
     * @return string[]
     */
    public static function getList(bool $emptyLine = true): array
    {
        $return = [];
        if ($emptyLine) {
            $return['-1'] = '---';
        }

        static::get()->map(function ($item) use (&$return) {
            $return[$item->id] = $item->name;
        });

        return $return;
    }
}
