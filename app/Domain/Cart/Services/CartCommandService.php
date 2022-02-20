<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Dto\ProductData;
use App\Domain\Cart\Http\Requests\{
    FinishedCartRequest,
    AddToCartRequest,
    UpdateToCartRequest,
    RemoveFromCartRequest,
    ExportToCartRequest
};
use Illuminate\Http\Request;

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

    /**
     * @param ExportToCartRequest $request
     * @param int $trelloCardId
     * @return CartInterface
     */
    public function updateTrelloCard(ExportToCartRequest $request, int $trelloCardId): CartInterface
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
            ->associateProduct(ProductData::fromRequest($request));
    }

    /**
     * update product
     *
     * @param UpdateToCartRequest $request
     * @return CartInterface
     */
    public function updateProduct(UpdateToCartRequest $request): CartInterface
    {
        return $this->cartRepository
            ->updateProduct(ProductData::fromRequest($request));
    }

    /**
     * remove product
     *
     * @param RemoveFromCartRequest $request
     * @return CartInterface
     */
    public function removeProduct(RemoveFromCartRequest $request): CartInterface
    {
        return $this->cartRepository
            ->dissociateProduct(ProductData::fromRequest($request));
    }

    /**
     * @TODO : verify request type - migrate to schedule -> use event driving
     *
     * @param ExportToCartRequest $request
     * @param $recipes
     * @return CartInterface
     */
    public function addProductFromRecipes(ExportToCartRequest $request, $recipes): CartInterface
    {
        $request->validated();

        $cart = $this->cartRepository->getCurrentOrCreate();

        $recipes->map(function ($recipe) use ($request) {
            $this->cartRepository->addOrUpdateProducts($request, $recipe->products);
        });

        return $cart;
    }

}
