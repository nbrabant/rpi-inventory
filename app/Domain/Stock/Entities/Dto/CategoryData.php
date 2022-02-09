<?php


namespace App\Domain\Stock\Entities\Dto;

use App\Domain\Stock\Http\Requests\CategoryRequest;
use App\Infrastructure\Entities\Dto;

/**
 * Class CategoryData
 * @property int id
 * @property string name
 * @property int position
 * @package App\Domain\Stock\Entities\Dto
 */
class CategoryData extends Dto
{
    /**
     * @param CategoryRequest $request
     * @return static
     */
    public static function fromRequest(CategoryRequest $request): self
    {
        return new static([
            'id'        => $request->getId(),
            'name'      => $request->getName(),
            'position'  => $request->getPosition(),
        ]);
    }
}