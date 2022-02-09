<?php

namespace App\Domain\Cart\Http\Resources;

use App\Domain\Cart\Contracts\CartInterface;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Cart\Services\CartCommandService;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Http\Requests\{
    AddToCartRequest,
    UpdateToCartRequest,
    RemoveFromCartRequest
};

class CartProducts extends Controller
{
    /**
     * @var CartCommandService $cartCommandService
     */
    private CartCommandService $cartCommandService;
    /**
     * @var CartQueryService $cartQueryService
     */
    private CartQueryService $cartQueryService;

    /**
     * @param CartCommandService $cartCommandService
     * @param CartQueryService $cartQueryService
     */
    public function __construct(
        CartCommandService $cartCommandService,
        CartQueryService $cartQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->cartQueryService = $cartQueryService;
    }

    /**
     * @param AddToCartRequest $request
     * @return CartInterface
     */
    public function store(AddToCartRequest $request): CartInterface
    {
        return $this->cartCommandService->attachProduct($request);
    }

    /**
     * @param UpdateToCartRequest $request
     * @param int $id
     * @return CartInterface
     */
    public function update(UpdateToCartRequest $request, int $id): CartInterface
    {
        return $this->cartCommandService->updateProduct($request);
    }

    /**
     * @param RemoveFromCartRequest $request
     * @param int $product_id
     * @return CartInterface
     */
    public function destroy(RemoveFromCartRequest $request, int $product_id): CartInterface
    {
        return $this->cartCommandService->removeProduct($request);
    }
}
