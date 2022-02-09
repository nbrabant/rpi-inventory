<?php

namespace App\Domain\Cart\Contracts;

use App\Domain\Cart\Entities\Dto\ProductData;
use App\Infrastructure\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;
use App\Domain\Cart\Contracts\CartInterface;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Create if it need and return current active cart
	 * 
	 * @return CartInterface
	 */
	public function getCurrentOrCreate(): CartInterface;

	/**
	 * Retrieve current active cart
	 * 
	 * @return CartInterface
	 */
	public function getCurrent(): CartInterface;

	/**
	 * Fill current active cart with attributes and return it
	 *
	 * @param Request $request
	 * @param mixed[] $attributes
	 * @return CartInterface
	 */
	public function updateCurrent(Request $request, array $attributes): CartInterface;

	/**
	 * Determine if current active cart has the specified product
	 * 
	 * @param int $productId
	 * @return bool
	 */
	public function cartHasProduct(int $productId): bool;

	/**
	 * Associate product to current active cart
	 *
	 * @param ProductData $productData
	 * @return CartInterface
	 */
	public function associateProduct(ProductData $productData): CartInterface;

	/**
	 * Update cart's product information
	 *
	 * @param ProductData $productData
	 * @return CartInterface
	 */
	public function updateProduct(ProductData $productData): CartInterface;

	/**
	 * Dissociate product to current cart
	 *
	 * @param ProductData $productData
	 * @return CartInterface
	 */
	public function dissociateProduct(ProductData $productData): CartInterface;

	/**
	 * Remove all the products of current cart
	 * 
	 * @return CartInterface
	 */
	public function purgeCart(Request $request): CartInterface;

	/**
	 * Synchronize product added to cart
	 *
	 * @param Request $request
	 * @param [type] $recipeProducts
	 * @return CartInterface
	 */
	public function addOrUpdateProducts(Request $request, $recipeProducts): CartInterface;

}