<?php

namespace App\Domain\Cart\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;
use App\Domain\Cart\Contracts\CartInterface;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Create if it need and return current active cart
	 * 
	 * @param Request $request
	 * @return CartInterface
	 */
	public function getCurrentOrCreate(Request $request): CartInterface;

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
	 * @param array $attributes
	 * @return CartInterface
	 */
	public function updateCurrent(Request $request, $attributes): CartInterface;

	/**
	 * Determine if current active cart has the specified product
	 * 
	 * @param int $product_id
	 * @return bool
	 */
	public function cartHasProduct($product_id): bool;

	/**
	 * Associate product to current active cart
	 *
	 * @param Request $request
	 * @param [type] $attributes
	 * @return CartInterface
	 */
	public function associateProduct(Request $request, $attributes): CartInterface;

	/**
	 * Update cart's product information
	 *
	 * @param Request $request
	 * @param [type] $attributes
	 * @param int $product_id
	 * @return CartInterface
	 */
	public function updateProduct(Request $request, $attributes, $product_id): CartInterface;

	/**
	 * Dissociate product to current cart
	 *
	 * @param Request $request
	 * @param int $product_id
	 * @return CartInterface
	 */
	public function dissociateProduct(Request $request, $product_id): CartInterface;

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