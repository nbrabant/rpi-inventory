<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Requests\{
    FinishedCartRequest,
    AddToCartRequest,
    UpdateToCartRequest,
    RemoveFromCartRequest,
    ExportCartRequest
};

class CartCommandService
{
    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private CartRepositoryInterface $cartRepository;

    /**
     * Create Cart Command Service instance.
     *
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param FinishedCartRequest $request
     * @return CartInterface
     */
    public function updateCart(FinishedCartRequest $request): CartInterface
    {
        return $this->cartRepository
            ->updateCurrent($request, $request->validated());
    }

    public function updateTrelloCard(Request $request, $trelloCardId): CartInterface
    {
        return $this->cartRepository
            ->updateCurrent($request, ['trello_card_id' => $trelloCardId]);
    }

    /**
     * add product
     *
     * @param AddToCartRequest $request
     * @return CartInterface
     */
    public function attachProduct(AddToCartRequest $request): CartInterface
    {
        return $this->cartRepository
            ->associateProduct($request, $request->validated());
    }

    /**
     * update product
     *
     * @param UpdateToCartRequest $request
     * @param $cart_id
     * @return CartInterface
     */
    public function updateProduct(UpdateToCartRequest $request, $cart_id): CartInterface
    {
        return $this->cartRepository
            ->updateProduct($request, $request->validated(), $request->validated()['product_id']);
    }

    /**
     * remove product
     *
     * @param RemoveFromCartRequest $request
     * @param $product_id
     * @return CartInterface
     */
    public function removeProduct(RemoveFromCartRequest $request, $product_id): CartInterface
    {
        return $this->cartRepository
            ->dissociateProduct($request->validated(), $product_id);
    }

    /**
     * @param ExportCartRequest $request
     * @param $recipes
     * @return CartInterface
     */
    public function addProductFromRecipes(ExportCartRequest $request, $recipes): CartInterface
    {
        $request->validated();

        $cart = $this->cartRepository->getCurrentOrCreate();

        if ($request->exportType === 'cleanexport') {
            $this->cartRepository->purgeCart($request);
        }

        $recipes->map(function ($recipe) use ($request) {
            $cart = $this->cartRepository->addOrUpdateProducts($request, $recipe->products);
        });

        return $cart;
    }

}
