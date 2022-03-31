<?php

namespace App\Domain\Cart\Tests\Feature\Services;

use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Http\Requests\AddToCartRequest;
use App\Domain\Cart\Http\Requests\RemoveFromCartRequest;
use App\Domain\Cart\Http\Requests\UpdateToCartRequest;
use App\Domain\Cart\Repositories\CartRepository;
use App\Domain\Cart\Services\CartCommandService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartCommandServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var CartCommandService $cartCommandService
     */
    private CartCommandService $cartCommandService;
    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private CartRepositoryInterface $cartRepository;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->cartRepository = new CartRepository($this->app);
        $this->cartCommandService = new CartCommandService($this->cartRepository);

        $this->seed();
    }

    /**
     * Test CurrentOrCreate for initialized database should return first cart
     *
     * @return void
     */
    public function testCurrentOrCreateForInitializedDatabaseShouldReturnFirstCart(): void
    {
        $cart = $this->cartRepository->getCurrentOrCreate();

        self::assertEquals(1, $cart->id);
    }

    /**
     * Test attach product action add product to current cart
     *
     * @return void
     */
    public function testAttachProductShouldPopulateProductToCart(): void
    {
        $this->cartCommandService->attachProduct(new AddToCartRequest([
            'product_id' => 2,
            'quantity' => 1,
        ]));

        /** @var Cart $cart */
        $cart = $this->cartRepository->getCurrentOrCreate();

        self::assertEquals(1, $cart->productLines()->count());
        self::assertEquals(2, $cart->productLines()->first()->product_id);
        self::assertEquals(1, $cart->productLines()->first()->quantity);
    }

    public function testUpdateProductShouldUpdateProductQuantityInCart(): void
    {
        $this->cartCommandService->attachProduct(new AddToCartRequest([
            'product_id' => 2,
            'quantity' => 1,
        ]));

        $this->cartCommandService->updateProduct(new UpdateToCartRequest([
            'product_id' => 2,
            'quantity' => 5,
        ]));

        /** @var Cart $cart */
        $cart = $this->cartRepository->getCurrentOrCreate();

        self::assertEquals(1, $cart->productLines()->count());
        self::assertEquals(2, $cart->productLines()->first()->product_id);
        self::assertEquals(5, $cart->productLines()->first()->quantity);
    }

    /**
     * Test dissociate product action remove product from current cart
     *
     * @return void
     */
    public function testDissociateProductShouldRemoveProductFromCart(): void
    {
        $this->cartCommandService->attachProduct(new AddToCartRequest([
            'product_id' => 2,
            'quantity' => 1,
        ]));

        $this->cartCommandService->removeProduct(new RemoveFromCartRequest([
            'product_id' => 2,
        ]));

        /** @var Cart $cart */
        $cart = $this->cartRepository->getCurrentOrCreate();

        self::assertEquals(0, $cart->productLines()->count());
    }
}