<?php


namespace App\Domain\Stock\Entities\Dto;

use App\Domain\Stock\Http\Requests\ProductRequest;
use App\Infrastructure\Entities\Dto;
use Illuminate\Support\Collection;

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

    /**
     * @param $productsDatas
     * @return Collection
     */
    public static function fromJson($productsDatas): Collection
    {
        return collect(json_decode($productsDatas))->map(function ($productData) {
            return new static([
                'product_id'    => $productData->product_id,
                'quantity'      => $productData->quantity,
            ]);
        });
    }
}