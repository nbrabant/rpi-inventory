<?php

namespace App\Domain\Stock\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    public function __toString(): string
    {
        return $this->name;
    }

    protected $fillable = [
        'name',
        'position'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeByPosition($query, $order = 'ASC')
    {
        if (!in_array($order, ['ASC', 'DESC'])) {
            $order = 'ASC';
        }
        return $query->orderBy('position', $order);
    }

    public static function getList($emptyLine = true)
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
