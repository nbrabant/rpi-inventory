<?php

namespace App\Domain\Stock\Entities\Dto;

use App\Domain\Stock\Http\Requests\OperationRequest;
use App\Infrastructure\Entities\Dto;

class OperationData extends Dto
{
    /**
     * @param OperationRequest $request
     * @return static
     */
    public static function fromRequest(OperationRequest $request): self
    {
        return new static([
            'product_id'    => $request->getProductId(),
            'quantity'      => $request->getQuantity(),
            'operation'     => $request->getOperation(),
            'detail'        => $request->getDetail(),
        ]);
    }
}