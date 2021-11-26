<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Http\Requests\{
    FinishedCartRequest,
    AddToCartRequest,
    UpdateToCartRequest,
    RemoveFromCartRequest,
    ExportCartRequest
};
use Illuminate\Http\Request;

/**
 * @property CartRepositoryInterface $cartRepository
 */
class CartCommandService
{
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

    /**
     * @param ExportCartRequest $request
     * @param int $trelloCardId
     * @return CartInterface
     */
    public function updateTrelloCard(ExportCartRequest $request, int $trelloCardId): CartInterface
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
     * @param int $cart_id
     * @return CartInterface
     */
    public function updateProduct(UpdateToCartRequest $request, int $cart_id): CartInterface
    {
        return $this->cartRepository
            ->updateProduct($request, $request->validated(), $request->validated()['product_id']);
    }

    /**
     * remove product
     *
     * @param RemoveFromCartRequest $request
     * @param int $product_id
     * @return CartInterface
     */
    public function removeProduct(RemoveFromCartRequest $request, int $product_id): CartInterface
    {
        return $this->cartRepository
            ->dissociateProduct($request->validated(), $product_id);
    }

    /**
     * @TODO : verify request type
     *
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
