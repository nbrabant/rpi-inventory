<?php


namespace App\Infrastructure\Entities\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Listable
{
    /**
     * @param Builder $query
     * @param array $ids
     * @return Builder
     */
    public function scopeWithoutIds(Builder $query, array $ids = []): Builder
    {
        if (is_array($ids) && !empty($ids)) {
            $query->whereNotIn('id', $ids);
        }
        return $query;
    }

    /**
     * @param null $withoutId
     * @param bool $emptyLine
     * @return Model[]
     */
    public static function getList($withoutId = null, bool $emptyLine = true): array
    {
        $return = [];
        if ($emptyLine) {
            $return['-1'] = '---';
        }

        static::without($withoutId)->get()->map(function ($item) use (&$return) {
            $return[$item->id] = $item->name;
        });

        return $return;
    }
}