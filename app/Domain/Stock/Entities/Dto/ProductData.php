<?php


namespace App\Domain\Stock\Entities\Dto;


use App\Domain\Stock\Http\Requests\ProductRequest;
use App\Infrastructure\Entities\Dto;

class ProductData extends Dto
{
    /**
     * @param ProductRequest $request
     * @return static
     */
    public static function fromRequest(ProductRequest $request): self
    {
        return new static([
            'id'            => $request->getId(),
            'category_id'   => $request->getCategoryId(),
            'name'          => $request->getName(),
            'description'   => $request->getDescription(),
            'min_quantity'  => $request->getMinQuantity(),
            'unit'          => $request->getUnit(),
        ]);
    }
}