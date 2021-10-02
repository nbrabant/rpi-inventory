<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Contracts\CartInterface;
use Illuminate\Http\Request;
use App\Application\Exceptions\ValidationException;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use Validator;
use App\Domain\Cart\Rules\NotInCart;
use App\Domain\Cart\Rules\IsInCart;

class CartCommandService
{
    /** @var CartRepositoryInterface $cartRepository */
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
     * @param Request $request
     * @return CartInterface
     */
    public function updateCart(Request $request): CartInterface
    {
        $request->validate([
            'finished' => 'boolean'
        ]);

        $attributes = $request->only(['finished']);

        return $this->cartRepository->updateCurrent($request, $attributes);
    }

    public function updateTrelloCard(Request $request, $trelloCardId): CartInterface
    {
        return $this->cartRepository->updateCurrent($request, ['trello_card_id' => $trelloCardId]);
    }

    /**
     * add product
     *
     * @param Request $request
     * @return CartInterface
     */
    public function attachProduct(Request $request): CartInterface
    {
        $request->validate([
            'product_id' => ['required', 'integer', new NotInCart],
            'quantity' => 'required|integer'
        ]);

        $attributes = $request->only(['product_id', 'quantity']);

        return $this->cartRepository->associateProduct($request, $attributes);
    }

    /**
     * update product
     *
     * @param Request $request
     * @param $cart_id
     * @return CartInterface
     */
    public function updateProduct(Request $request, $cart_id): CartInterface
    {
        $request->validate([
            'product_id' => ['required', 'integer', new IsInCart],
            'quantity' => 'required|integer'
        ]);

        $attributes = $request->only(['product_id', 'quantity']);

        return $this->cartRepository->updateProduct($request, $attributes, $attributes['product_id']);
    }

    /**
     * remove product
     *
     * @param Request $request
     * @param $product_id
     * @return CartInterface
     * @throws ValidationException
     */
    public function removeProduct(Request $request, $product_id): CartInterface
    {
        $validator = Validator::make(['product_id' => $product_id], [
            'product_id' => ['required', 'integer', new IsInCart]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        return $this->cartRepository->dissociateProduct($request, $product_id);
    }

    /**
     * @param Request $request
     * @param $recipes
     * @return CartInterface
     */
    public function addProductFromRecipes(Request $request, $recipes): CartInterface
    {
        $request->validate([
            'exportType' => ['in:export,cleanexport']
        ]);

        $cart = $this->cartRepository->getCurrentOrCreate($request);

        if ($request->exportType === 'cleanexport') {
            $this->cartRepository->purgeCart($request);
        }

        $recipes->map(function ($recipe) use ($request) {
            $cart = $this->cartRepository->addOrUpdateProducts($request, $recipe->products);
        });

        return $cart;
    }

}
