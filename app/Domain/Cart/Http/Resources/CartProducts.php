<?php

namespace App\Domain\Cart\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Cart\Services\CartCommandService;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Requests\{
    AddToCartRequest,
    UpdateToCartRequest,
    RemoveFromCartRequest
};

/**
 * @property CartCommandService cartCommandService
 * @property CartQueryService cartQueryService
 */
class CartProducts extends Controller
{
    public function __construct(
        CartCommandService $cartCommandService,
        CartQueryService $cartQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->cartQueryService = $cartQueryService;
    }

    public function store(AddToCartRequest $request)
    {
        return $this->cartCommandService->attachProduct($request);
    }

    public function update(UpdateToCartRequest $request, $id)
    {
        return $this->cartCommandService->updateProduct($request, $id);
    }

    public function destroy(RemoveFromCartRequest $request, $product_id)
    {
        return $this->cartCommandService->removeProduct($request, $product_id);
    }
}
